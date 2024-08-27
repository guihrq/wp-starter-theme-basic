<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package WordPress
 * @subpackage Your_Theme
 * @since Your Theme 1.0
 */
?>

<!-- Footer -->
<footer class="site-footer bg-light pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Products</h5>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_products',
                    'container' => 'div',
                    'container_class' => 'sitemap-links',
                    'menu_class' => 'list-unstyled',
                    'fallback_cb' => false, // Evita a exibição de uma lista padrão se o menu não existir
                ));
                ?>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Services</h5>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_services',
                    'container' => 'div',
                    'container_class' => 'sitemap-links',
                    'menu_class' => 'list-unstyled',
                    'fallback_cb' => false, // Evita a exibição de uma lista padrão se o menu não existir
                ));
                ?>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact</h5>
                <address>
                    1234 Street Name, City, State, Zip<br>
                    Phone: (123) 456-7890<br>
                    Email: <a href="malito:info@example.com" target="_blank">info@example.com</a>
                </address>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Redes Sociais</h5>
                <div class="social-media-links">
                    <?php
                    // Obtém os locais de menu registrados
                    $locations = get_nav_menu_locations();
                    // Verifica se o local 'footer_sociamedia' está registrado
                    if (isset($locations['footer_sociamedia'])) {
                        $menu_id = $locations['footer_sociamedia'];
                        $menu_items = wp_get_nav_menu_items($menu_id);
                        if ($menu_items) {
                            foreach ($menu_items as $item) {
                                // Mapeia o título para a classe do ícone correspondente
                                $icon_class = '';
                                switch (strtolower($item->title)) {
                                    case 'facebook':
                                        $icon_class = 'facebook';
                                        break;
                                    case 'instagram':
                                        $icon_class = 'instagram';
                                        break;
                                    case 'youtube':
                                        $icon_class = 'youtube';
                                        break;
                                    case 'x':
                                        $icon_class = 'x';
                                        break;
                                    case 'linkedin':
                                        $icon_class = 'linkedin';
                                        break;
                                    default:
                                        $icon_class = 'default'; // Opcional, se você tiver um ícone padrão
                                        break;
                                }
                                if ($icon_class) {
                                    echo '<a href="' . esc_url($item->url) . '" target="_blank" title="' . esc_attr($item->title) . '">';
                                    echo '<img class="socialmedia_footer" src="' . get_template_directory_uri() . '/assets/images/redes-sociais/' . $icon_class . '.png" alt="' . esc_attr($item->title) . '" />';
                                    echo '</a> ';
                                }
                            }
                        } else {
                            echo '<p>Não há itens no menu de redes sociais.</p>';
                        }
                    } else {
                        echo '<p>Menu de redes sociais não encontrado. Verifique o nome do local do menu.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-dark text-light py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
        </div>
    </div>
    <div class="img-topo">
        <img id="button" src="<?php echo get_template_directory_uri(); ?>/assets/images/scrolltop.png" alt="Seta Topo">
    </div>
</footer>

<a href="https://api.whatsapp.com/send?phone=51000000000&text=olá" class="whatsapp-button" target="_blank" style="position: fixed;  right: 15px; bottom: 210px;">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wpp.png" alt="botão whatsapp" width="45px;">
</a>

<div class="lgpd">
    <div class="lgpd-container">
        <div class="lgpd-preferences" data-lgpd-preferences="">
            <p class="lgpd-preferences-header">Saiba mais sobre os cookies nos links: <a class="lgpd-link" href="/politica-de-cookies/">política de cookies</a> e <a class="lgpd-link" href="/politica-de-privacidade/">política de privacidade</a></p>
            <ul class="lgpd-switch">
                <li class="lgpd-switch-item">
                    <button id="switchEssential" title="Não é possível utilizar o site sem essas funcionalidades" class="lgpd-switch-toggle" role="switch" disabled aria-checked="true" aria-labelledby="lgpd-itens-essenciais"></button>
                    <span alt="Só é possível desabilitar diretamente no browser.">Funcionalidades Essenciais</span>
                </li>
                <li class="lgpd-switch-item">
                    <button id="switchAnalytics" class="lgpd-switch-toggle" data-lgpd-id="analytics" role="switch" aria-checked="true" aria-labelledby="lgpd-itens-analise"></button>
                    <span id="lgpd-itens-analise">Análise de Uso do Site</span>
                </li>
                <li class="lgpd-switch-item">
                    <button id="switchAds" class="lgpd-switch-toggle" data-lgpd-id="ads" role="switch" aria-checked="true" aria-labelledby="lgpd-itens-anuncios"></button>
                    <span id="lgpd-itens-anuncios">Anúncios Personalizados</span>
                </li>
            </ul>
        </div>
        <div class="lgpd-info">
            <p>Este site utiliza cookies para a análise de uso e anúncios.</p>
            <div class="lgpd-buttons">
                <button id="btnPersonalizar" class="lgpd-personalizar" data-lgpd-personalizar="">Personalizar</button>
                <button id="btnContinuar" class="lgpd-save" data-lgpd-save="">Continuar</button>
            </div>
        </div>
    </div>
</div>

<!-- Custom JavaScript -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.mask.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/flikity.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/carrossel.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/forms.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/analytics.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>
<?php wp_footer(); ?>
</body>
</html>
