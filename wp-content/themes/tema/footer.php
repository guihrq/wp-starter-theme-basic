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
            <!-- Sitemap Section -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Company</h5>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_company',
                    'container' => 'div',
                    'container_class' => 'sitemap-links',
                    'menu_class' => 'list-unstyled',
                ));
                ?>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Products</h5>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_products',
                    'container' => 'div',
                    'container_class' => 'sitemap-links',
                    'menu_class' => 'list-unstyled',
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
                ));
                ?>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact</h5>
                <address>
                    1234 Street Name, City, State, Zip<br>
                    Phone: (123) 456-7890<br>
                    Email: info@example.com
                </address>
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
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/carrossel.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>
<?php wp_footer(); ?>
</body>
</html>
