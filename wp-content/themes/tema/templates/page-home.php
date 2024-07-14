<?php
/**
 * Template Name: Home
 */

get_header('fixed-dropdown'); ?>

<!-- Sessão 1: Vídeo Banner -->
<section id="video" class="mb-5">
    <div class="container-full">
        <div class="row">
            <div class="col-md-12">
                <video src="<?php the_field('banner_video'); ?>" loading="lazy" class="video-background" autoplay loop muted></video>
                <div class="content text-center text-light text-uppercase">
                    <h2><?php the_field('titulo_banner_video'); ?></h2>
                    <h4><?php the_field('subtitulo_banner_video'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessão 2: Carrossel de Banners -->
<section id="banners" class="py-5">
    <div class="container-full">
        <div class="row">
            <div class="col-lg-12">
                <div class="carousel-banners">
                    <?php 
                    $banners = get_field('banners_carousel');
                    if ($banners) :
                        foreach ($banners as $banner) : ?>
                            <div class="carousel-cell">
                                <div class="banner text-center">
                                    <img src="<?php echo $banner['banner_image_desktop']; ?>" class="img-fluid d-none d-sm-block d-md-block d-lg-block" alt="Banner Desktop">
                                    <img src="<?php echo $banner['banner_image_mobile']; ?>" class="img-fluid d-block d-sm-none d-md-none d-lg-none" alt="Banner Mobile">
                                    <div class="content text-center text-light text-uppercase">
                                        <h2><?php echo $banner['titulo_banner']; ?></h2>
                                    </div>
                                </div>
                            </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessão 2: Hero -->
<section id="hero" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h1><?php the_field('hero_title'); ?></h1>
                <p><?php the_field('hero_subtitle'); ?></p>
                <a href="<?php the_field('hero_button_link'); ?>" class="btn btn-primary"><?php the_field('hero_button_text'); ?></a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <img src="<?php the_field('hero_image'); ?>" alt="Hero Image" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Sessão 3: Sobre -->
<section id="sobre" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('sobre_title'); ?></h2>
                <p><?php the_field('sobre_content'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Sessão 4: Serviços -->
<section id="servicos" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('servicos_title'); ?></h2>
            </div>
            <?php if( have_rows('servicos_items') ): ?>
                <?php while( have_rows('servicos_items') ): the_row(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <img src="<?php the_sub_field('servico_image'); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php the_sub_field('servico_title'); ?></h5>
                                <p class="card-text"><?php the_sub_field('servico_description'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Sessão 5: Portfólio -->
<section id="portfolio" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('portfolio_title'); ?></h2>
            </div>
            <?php if( have_rows('portfolio_items') ): ?>
                <?php while( have_rows('portfolio_items') ): the_row(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <img src="<?php the_sub_field('portfolio_image'); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php the_sub_field('portfolio_title'); ?></h5>
                                <p class="card-text"><?php the_sub_field('portfolio_description'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Carrossel Depoimentos -->
<?php include(TEMPLATEPATH . "/carrosseis/depoimentos.php"); ?>

<!-- Sessão 7: Blog -->
<section id="blog" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('blog_title'); ?></h2>
            </div>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 3,
                'post_status' => 'publish',
            ));
            foreach($recent_posts as $post) : ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <?php if ( has_post_thumbnail($post['ID']) ) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url($post['ID']); ?>" class="card-img-top" alt="...">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['post_title']; ?></h5>
                            <p class="card-text"><?php echo wp_trim_words($post['post_content'], 15); ?></p>
                            <a href="<?php echo get_permalink($post['ID']); ?>" class="btn btn-primary">Leia Mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; wp_reset_query(); ?>
        </div>
    </div>
</section>

<!-- Formulário Contato -->
<?php include(TEMPLATEPATH . "/forms/formulario-contato.php"); ?>

<?php get_footer(); ?>
