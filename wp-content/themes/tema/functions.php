<?php
// Adicionar suporte a funcionalidades do tema
function theme_setup() {
    // Suporte a imagens destacadas
    add_theme_support('post-thumbnails');
    
    // Suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Registrar menus de navegação
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'footer_products' => __('Footer Products Menu'),
            'footer_services' => __('Footer Services Menu'),
            'footer_sociamedia' => __('Footer Social Media Menu'),
        )
    );
}
add_action('after_setup_theme', 'theme_setup');

// Classe Walker personalizada para o Bootstrap 5
class Bootstrap_5_WP_Nav_Menu_Walker extends Walker_Nav_Menu {
    private $current_item;
    private $dropdown_menu_alignment_values = [
        'dropdown-menu-start',
        'dropdown-menu-end',
        'dropdown-menu-sm-start',
        'dropdown-menu-sm-end',
        'dropdown-menu-md-start',
        'dropdown-menu-md-end',
        'dropdown-menu-lg-start',
        'dropdown-menu-lg-end',
        'dropdown-menu-xl-start',
        'dropdown-menu-xl-end',
    ];

    function start_lvl( &$output, $depth = 0, $args = null ) {
        $dropdown_menu_class[] = '';
        foreach( $this->current_item->classes as $class ) {
            if( in_array( $class, $this->dropdown_menu_alignment_values ) ) {
                $dropdown_menu_class[] = $class;
            }
        }
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr( implode( ' ', $dropdown_menu_class ) ) . " depth_$depth\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $this->current_item = $item;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-menu-end';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $attributes .= ' class="nav-link open ' . ( $depth > 0 ? 'dropdown-item ' : '' ) . '"';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Funções para Limpar o Header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Habilitar Menus
// add_theme_support('menus');

// function create_post_type() {
//     register_post_type( 'profissionais',
//         array(
//             'labels' => array(
//                 'name' => 'Profissionais',
//                 'singular_name' => 'Profissional',
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'menu_position' => 16,
//             'menu_icon' => 'dashicons-id-alt',
//             'supports' => array( 'title', 'editor' ),
//             'rewrite' => false,
//             'query_var' => false,
//             'publicly_queryable' => false,
//         )
//     );

//     register_post_type( 'parceiros',
//         array(
//             'labels' => array(
//                 'name' => 'Parceiros',
//                 'singular_name' => 'Parceiro',
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'menu_position' => 16,
//             'menu_icon' => 'dashicons-groups',
//             'supports' => array( 'title', 'editor' ),
//             'rewrite' => false,
//             'query_var' => false,
//             'publicly_queryable' => false,
//         )
//     );
// }
// add_action( 'init', 'create_post_type' );

/** Pagination */
function pagination_function() {
    // Get total number of pages
    global $wp_query;
    $total = $wp_query->max_num_pages;
    
    // Only paginate if we have more than one page
    if ( $total > 1 )  {
        // Get the current page
        if ( !$current_page = get_query_var('paged') )
            $current_page = 1;
                            
        $big = 999999999;
        // Structure of "format" depends on whether we’re using pretty permalinks
        $permalink_structure = get_option('permalink_structure');
        $format = empty( $permalink_structure ) ? '&page=%#%' : 'page/%#%/';
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => $format,
            'current' => $current_page,
            'total' => $total,
            'mid_size' => 2,
            'type' => 'list'
        ));
    }
}
/** END Pagination */

// CONTADOR DE POSTS MAIS VISITADOS

// Remover estilos globais
function remove_global_styles() {
    wp_dequeue_style( 'global-styles' );
    wp_deregister_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_global_styles', 100 );

// Remover classes da tag <body>
function remove_body_classes( $classes ) {
    // Lista das classes que deseja remover
    $classes_to_remove = array(
        'page-template',
        'page-template-templates',
        'page-template-page-home',
        'page-template-templatespage-home-php',
    );

    // Remove as classes específicas da lista
    foreach ( $classes_to_remove as $class ) {
        if ( in_array( $class, $classes ) ) {
            $key = array_search( $class, $classes );
            if ( $key !== false ) {
                unset( $classes[ $key ] );
            }
        }
    }

    return $classes;
}
add_filter( 'body_class', 'remove_body_classes' );

function remove_wp_emoji_script() {
    // Remove o script principal de emojis do WordPress
    wp_dequeue_script( 'wp-emoji-release' );

    // Remove o script de configurações de emojis do WordPress
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Remove o inline CSS gerado para emojis
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Remove o filtro para remover o link de feed de emojis do cabeçalho
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );

    // Remove emoji CDN hostname do DNS prefetching de navegadores modernos
    add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_emoji_script' );

function remove_wp_emoji_style() {
    // Remove o estilo inline dos emojis
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Remove o link do estilo externo dos emojis
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_emoji_style' );

function remove_classic_theme_styles() {
    // Remove o estilo inline gerado automaticamente
    wp_dequeue_style( 'classic-theme-styles' );
    wp_deregister_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_classic_theme_styles', 100 );

function remove_wp_emoji_style_inline() {
    // Remove o estilo inline dos emojis
    wp_dequeue_style( 'wp-emoji-styles' );
    wp_deregister_style( 'wp-emoji-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_emoji_style_inline', 100 );

function add_custom_js_to_footer() {
    ?>
    <script>
        // Espera até que o documento esteja completamente carregado
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Seletor para o estilo inline específico que deseja remover
        //     var inlineStyleToRemove = `
        //         *,
        //         ::before,
        //         ::after {
        //             --tw-border-spacing-x: 0;
        //             --tw-border-spacing-y: 0;
        //             --tw-translate-x: 0;
        //             --tw-translate-y: 0;
        //             --tw-rotate: 0;
        //             --tw-skew-x: 0;
        //             --tw-skew-y: 0;
        //             --tw-scale-x: 1;
        //             --tw-scale-y: 1;
        //             --tw-pan-x: ;
        //             --tw-pan-y: ;
        //             --tw-pinch-zoom: ;
        //             --tw-scroll-snap-strictness: proximity;
        //             --tw-ordinal: ;
        //             --tw-slashed-zero: ;
        //             --tw-numeric-figure: ;
        //             --tw-numeric-spacing: ;
        //             --tw-numeric-fraction: ;
        //             --tw-ring-inset: ;
        //             --tw-ring-offset-width: 0px;
        //             --tw-ring-offset-color: #fff;
        //             --tw-ring-color: rgb(59 130 246 / .5);
        //             --tw-ring-offset-shadow: 0 0 #0000;
        //             --tw-ring-shadow: 0 0 #0000;
        //             --tw-shadow: 0 0 #0000;
        //             --tw-shadow-colored: 0 0 #0000;
        //             --tw-blur: ;
        //             --tw-brightness: ;
        //             --tw-contrast: ;
        //             --tw-grayscale: ;
        //             --tw-hue-rotate: ;
        //             --tw-invert: ;
        //             --tw-saturate: ;
        //             --tw-sepia: ;
        //             --tw-drop-shadow: ;
        //             --tw-backdrop-blur: ;
        //             --tw-backdrop-brightness: ;
        //             --tw-backdrop-contrast: ;
        //             --tw-backdrop-grayscale: ;
        //             --tw-backdrop-hue-rotate: ;
        //             --tw-backdrop-invert: ;
        //             --tw-backdrop-opacity: ;
        //             --tw-backdrop-saturate: ;
        //             --tw-backdrop-sepia: ;
        //         }
        //     `;
            
        //     // Função para remover o estilo inline específico
        //     function removeInlineStyle() {
        //         // Encontra todos os elementos <style> no documento
        //         var styles = document.querySelectorAll('style');
        //         styles.forEach(function(style) {
        //             // Verifica se o conteúdo do estilo corresponde ao estilo a ser removido
        //             if (style.innerHTML.trim() === inlineStyleToRemove.trim()) {
        //                 // Remove o elemento <style> do DOM
        //                 style.remove();
        //             }
        //         });
        //     }
            
        //     // Chama a função para remover o estilo inline
        //     removeInlineStyle();
        // });
    </script>
    <?php
}
add_action('wp_footer', 'add_custom_js_to_footer');

// Adiciona o menu principal e o submenu
function adicionar_menu_formularios() {
    // Adiciona o menu principal com ícone de formulários
    add_menu_page(
        'Formulários', // Título da página
        'Formulários', // Título do menu
        'manage_options', // Capacidade necessária
        'formularios', // Slug do menu
        'mostrar_pagina_formularios', // Função callback para exibir o conteúdo
        'dashicons-forms', // Ícone do menu principal (ícone de formulários)
        6 // Posição no menu
    );

    // Adiciona o submenu "Contatos" com ícone de pessoa
    add_submenu_page(
        'formularios', // Slug do menu principal
        'Contatos', // Título da página do submenu
        'Contatos', // Título do submenu
        'manage_options', // Capacidade necessária
        'contatos', // Slug do submenu
        'mostrar_contatos' // Função callback para exibir o conteúdo do submenu
    );
}

// Registra a ação para adicionar o menu e submenu
add_action('admin_menu', 'adicionar_menu_formularios');

// Função para exibir a página principal "Formulários"
function mostrar_pagina_formularios() {
    ?>
    <div class="wrap">
        <h1>Formulários</h1>
        <div class="formulario-boxes">
            <div class="formulario-box">
                <a href="<?php echo esc_url(admin_url('admin.php?page=contatos')); ?>">
                    <div class="icon">
                        <span class="dashicons dashicons-admin-users"></span> <!-- Ícone -->
                    </div>
                    <h2>Formulário Contatos Home</h2>
                </a>
            </div>
            <!-- Adicione mais caixas aqui para outros formulários aqui -->
        </div>
    </div>
    <style>
        .formulario-boxes {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .formulario-box {
            width: 200px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            background-color: #fff;
            transition: transform 0.3s ease;
        }
        .formulario-box:hover {
            transform: scale(1.05);
        }
        .formulario-box .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .formulario-box h2 {
            font-size: 18px;
            margin: 10px 0;
        }
        .formulario-box p {
            font-size: 14px;
            color: #666;
        }
        .formulario-box a {
            text-decoration: none;
            color: inherit;
        }
    </style>
    <?php
}

// Função para exibir os contatos
function mostrar_contatos() {
    global $wpdb;
    $tabela = $wpdb->prefix . 'contatos';

    $itens_por_pagina = 50;
    $pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
    $offset = ($pagina_atual - 1) * $itens_por_pagina;

    $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'created_at';
    $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'DESC';

    $valid_orderby = array('nome', 'email', 'telefone', 'mensagem', 'created_at');
    if (!in_array($orderby, $valid_orderby)) {
        $orderby = 'created_at';
    }

    $valid_order = array('ASC', 'DESC');
    if (!in_array($order, $valid_order)) {
        $order = 'DESC';
    }

    $total_registros = $wpdb->get_var("SELECT COUNT(*) FROM $tabela");

    $query = $wpdb->prepare("SELECT * FROM $tabela ORDER BY $orderby $order LIMIT %d OFFSET %d", $itens_por_pagina, $offset);
    $contatos = $wpdb->get_results($query);
    ?>

    <div class="wrap">
        <h1>Contatos</h1>
        <p>Total de registros: <?php echo esc_html($total_registros); ?></p>
        <form id="export_csv_form" method="post">
            <input type="submit" id="exportcsv" name="export_csv" class="button button-primary" value="Exportar CSV">
        </form>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>
                        <a href="<?php echo esc_url(add_query_arg(array('orderby' => 'nome', 'order' => ($order == 'ASC' ? 'DESC' : 'ASC')), admin_url('admin.php?page=contatos'))); ?>">
                            Nome
                            <span class="sorting-indicators">
                                <span class="sorting-indicator asc <?php echo ($orderby === 'nome' && $order === 'ASC') ? 'active' : 'inactive'; ?>" aria-hidden="true"></span>
                                <span class="sorting-indicator desc <?php echo ($orderby === 'nome' && $order === 'DESC') ? 'active' : 'inactive'; ?>" aria-hidden="true"></span>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a href="<?php echo esc_url(add_query_arg(array('orderby' => 'email', 'order' => ($order == 'ASC' ? 'DESC' : 'ASC')), admin_url('admin.php?page=contatos'))); ?>">
                            Email
                            <span class="sorting-indicators">
                                <span class="sorting-indicator asc <?php echo ($orderby === 'email' && $order === 'ASC') ? 'active' : 'inactive'; ?>" aria-hidden="true"></span>
                                <span class="sorting-indicator desc <?php echo ($orderby === 'email' && $order === 'DESC') ? 'active' : 'inactive'; ?>" aria-hidden="true"></span>
                            </span>
                        </a>
                    </th>
                    <th>Telefone</th>
                    <th>Mensagem</th>
                    <th>
                        <a href="<?php echo esc_url(add_query_arg(array('orderby' => 'created_at', 'order' => ($order == 'ASC' ? 'DESC' : 'ASC')), admin_url('admin.php?page=contatos'))); ?>">
                            Data
                            <span class="sorting-indicators">
                                <span class="sorting-indicator asc <?php echo ($orderby === 'created_at' && $order === 'ASC') ? 'active' : 'inactive'; ?>" aria-hidden="true"></span>
                                <span class="sorting-indicator desc <?php echo ($orderby === 'created_at' && $order === 'DESC') ? 'active' : 'inactive'; ?>" aria-hidden="true"></span>
                            </span>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?php echo esc_html($contato->nome); ?></td>
                        <td><?php echo esc_html($contato->email); ?></td>
                        <td><?php echo esc_html($contato->telefone); ?></td>
                        <td><?php echo esc_html($contato->mensagem); ?></td>
                        <td><?php echo esc_html($contato->created_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            $total_paginas = ceil($total_registros / $itens_por_pagina);
            for ($i = 1; $i <= $total_paginas; $i++) {
                $class = ($i == $pagina_atual) ? 'current' : '';
                echo '<a class="' . $class . '" href="' . esc_url(add_query_arg(array('pagina' => $i), admin_url('admin.php?page=contatos'))) . '">' . $i . '</a> ';
            }
            ?>
        </div>
    </div>
    <style>
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #ddd;
            margin-right: 4px;
            color: #333;
        }
        .pagination a.current {
            background-color: #0073aa;
            color: white;
            border-color: #0073aa;
        }
        table.fixed {
            table-layout: fixed;
            margin-top: 20px;
        }
        .sorting-indicators {
            display: inline-block;
            margin-left: 5px;
        }
        .sorting-indicator {
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            margin-left: 5px;
        }
        .sorting-indicator.asc {
            border-bottom: 8px solid #333;
            display: none;
        }
        .sorting-indicator.desc {
            border-top: 8px solid #333;
            display: none;
        }
        .sorting-indicator.active.asc {
            display: inline-block;
        }
        .sorting-indicator.active.desc {
            display: inline-block;
        }
        .sorting-indicator.inactive {
            display: none;
        }
        .sorting-indicator.desc:before {
            display: none;
        }
        .sorting-indicator.asc:before {
            display: none;
        }
    </style>

    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('export_csv_form').addEventListener('submit', function(event) {
            event.preventDefault();

            var form = event.target;
            var formData = new FormData(form);
            formData.append('action', 'export_csv');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
            xhr.responseType = 'blob';

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var blob = xhr.response;
                    var link = document.createElement('a');
                    var url = URL.createObjectURL(blob);
                    link.href = url;
                    link.download = 'contatos.csv';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);
                } else {
                    alert('Erro ao exportar CSV.');
                }
            };
            xhr.send(formData);
        });
    });
    </script>
    <?php
}

// Função para exportar o CSV via AJAX
add_action('wp_ajax_export_csv', 'export_csv_function');
add_action('wp_ajax_nopriv_export_csv', 'export_csv_function'); // Permite a função para usuários não logados, se necessário

function export_csv_function() {
    global $wpdb;
    $tabela = $wpdb->prefix . 'contatos';

    // Captura a ordenação da URL
    $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'created_at';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';

    // Valida os parâmetros de ordenação
    $valid_orderby = array('nome', 'email', 'telefone', 'mensagem', 'created_at');
    if (!in_array($orderby, $valid_orderby)) {
        $orderby = 'created_at';
    }

    $valid_order = array('ASC', 'DESC');
    if (!in_array($order, $valid_order)) {
        $order = 'DESC';
    }

    // Consulta para obter os registros
    $query = $wpdb->prepare("SELECT * FROM $tabela ORDER BY $orderby $order");
    $contatos = $wpdb->get_results($query);

    // Configura o tipo de conteúdo e cabeçalhos para download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=contatos.csv');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    // Cria o arquivo CSV no buffer
    $csv_file = fopen('php://output', 'w');
    if ($csv_file === false) {
        wp_die('Não foi possível criar o arquivo CSV.');
    }

    // Escreve o cabeçalho do CSV
    fputcsv($csv_file, array('Nome', 'Email', 'Telefone', 'Mensagem', 'Data'));
    
    // Escreve os dados dos contatos
    foreach ($contatos as $contato) {
        fputcsv($csv_file, array($contato->nome, $contato->email, $contato->telefone, $contato->mensagem, $contato->created_at));
    }

    // Fecha o arquivo e encerra o script
    fclose($csv_file);
    exit();
}
?>
