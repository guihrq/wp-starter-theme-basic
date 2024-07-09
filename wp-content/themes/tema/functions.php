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
            'footer_company' => __('Footer Company Menu'),
            'footer_products' => __('Footer Products Menu'),
            'footer_services' => __('Footer Services Menu'),
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

        $class_names =  join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
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

    // Remove o filtro para remover o link de feed de emojis do cabeçalho
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Remover todos os filtros relacionados a emojis
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
    // jQuery(document).ready(function($) {
        // Seletor para o estilo inline específico que deseja remover
        // var inlineStyleToRemove = `
        //     *,
        //     ::before,
        //     ::after {
        //         --tw-border-spacing-x: 0;
        //         --tw-border-spacing-y: 0;
        //         --tw-translate-x: 0;
        //         --tw-translate-y: 0;
        //         --tw-rotate: 0;
        //         --tw-skew-x: 0;
        //         --tw-skew-y: 0;
        //         --tw-scale-x: 1;
        //         --tw-scale-y: 1;
        //         --tw-pan-x: ;
        //         --tw-pan-y: ;
        //         --tw-pinch-zoom: ;
        //         --tw-scroll-snap-strictness: proximity;
        //         --tw-ordinal: ;
        //         --tw-slashed-zero: ;
        //         --tw-numeric-figure: ;
        //         --tw-numeric-spacing: ;
        //         --tw-numeric-fraction: ;
        //         --tw-ring-inset: ;
        //         --tw-ring-offset-width: 0px;
        //         --tw-ring-offset-color: #fff;
        //         --tw-ring-color: rgb(59 130 246 / .5);
        //         --tw-ring-offset-shadow: 0 0 #0000;
        //         --tw-ring-shadow: 0 0 #0000;
        //         --tw-shadow: 0 0 #0000;
        //         --tw-shadow-colored: 0 0 #0000;
        //         --tw-blur: ;
        //         --tw-brightness: ;
        //         --tw-contrast: ;
        //         --tw-grayscale: ;
        //         --tw-hue-rotate: ;
        //         --tw-invert: ;
        //         --tw-saturate: ;
        //         --tw-sepia: ;
        //         --tw-drop-shadow: ;
        //         --tw-backdrop-blur: ;
        //         --tw-backdrop-brightness: ;
        //         --tw-backdrop-contrast: ;
        //         --tw-backdrop-grayscale: ;
        //         --tw-backdrop-hue-rotate: ;
        //         --tw-backdrop-invert: ;
        //         --tw-backdrop-opacity: ;
        //         --tw-backdrop-saturate: ;
        //         --tw-backdrop-sepia: ;
        //     }
        // `;
        
        // Função para remover o estilo inline específico
        // function removeInlineStyle() {
            // Encontra todos os elementos <style> no documento
            // $('style').each(function() {
                // Verifica se o conteúdo do estilo corresponde ao estilo a ser removido
                // if ($(this).html().trim() === inlineStyleToRemove.trim()) {
                    // Remove o elemento <style> do DOM
                    // $(this).remove();
                // }
            // });
        // }
        
        // Chama a função para remover o estilo inline
        // removeInlineStyle();
    // });
    </script>
    <?php
}
add_action('wp_footer', 'add_custom_js_to_footer');

?>
