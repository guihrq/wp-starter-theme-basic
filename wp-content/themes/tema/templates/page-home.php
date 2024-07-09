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
<div class="container mt-5">    

    <!-- Sessão 2: Hero -->
    <section id="hero" class="mb-5">
        <div class="row">
            <div class="col-md-6">
                <h1><?php the_field('hero_title'); ?></h1>
                <p><?php the_field('hero_subtitle'); ?></p>
                <a href="<?php the_field('hero_button_link'); ?>" class="btn btn-primary"><?php the_field('hero_button_text'); ?></a>
            </div>
            <div class="col-md-6">
                <img src="<?php the_field('hero_image'); ?>" alt="Hero Image" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- Sessão 3: Sobre -->
    <section id="sobre" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('sobre_title'); ?></h2>
                <p><?php the_field('sobre_content'); ?></p>
            </div>
        </div>
    </section>

    <!-- Sessão 4: Serviços -->
    <section id="servicos" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('servicos_title'); ?></h2>
            </div>
            <?php if( have_rows('servicos_items') ): ?>
                <?php while( have_rows('servicos_items') ): the_row(); ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
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
    </section>

    <!-- Sessão 5: Portfólio -->
    <section id="portfolio" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('portfolio_title'); ?></h2>
            </div>
            <?php if( have_rows('portfolio_items') ): ?>
                <?php while( have_rows('portfolio_items') ): the_row(); ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
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
    </section>

    <!-- Sessão 6: Depoimentos -->
    <section id="depoimentos" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('depoimentos_title'); ?></h2>
            </div>
            <?php if( have_rows('depoimentos_items') ): ?>
                <?php while( have_rows('depoimentos_items') ): the_row(); ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="card-text"><?php the_sub_field('depoimento_text'); ?></p>
                                <h5 class="card-title"><?php the_sub_field('depoimento_author'); ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Sessão 7: Blog -->
    <section id="blog" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('blog_title'); ?></h2>
            </div>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 6,
                'post_status' => 'publish',
            ));
            foreach($recent_posts as $post) : ?>
                <div class="col-md-4">
                    <div class="card mb-4">
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
    </section>

    <!-- Sessão 8: Contato -->
    <section id="contato" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('contato_title'); ?></h2>
                <p><?php the_field('contato_description'); ?></p>
                <?php echo do_shortcode('[contact-form-7 id="1234" title="Formulário de Contato"]'); ?>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
