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

<!-- Sessão 6: Depoimentos -->
<section id="depoimentos" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('depoimentos_title'); ?></h2>
            </div>
            <div class="carousel-depoimentos">
                <?php if( have_rows('depoimentos_items') ): ?>
                    <?php while( have_rows('depoimentos_items') ): the_row(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 carousel-cell">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text"><?php the_sub_field('depoimento_text'); ?></p>
                                    <h5 class="card-title"><?php the_sub_field('depoimento_author'); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Sessão 7: Blog -->
<section id="blog" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('blog_title'); ?></h2>
            </div>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 6,
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

<!-- Sessão 8: Contato -->
<section id="contato" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2><?php the_field('contato_title'); ?></h2>
                <p><?php the_field('contato_description'); ?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <form id="contactForm" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" novalidate>
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                        <div class="invalid-feedback">Por favor, informe seu nome.</div>
                    </div>
                
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Por favor, informe um email válido.</div>
                    </div>
                
                    <div class="form-group">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" required>
                        <div class="invalid-feedback">Por favor, informe um número de telefone válido.</div>
                    </div>
                
                    <div class="form-group">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="4" style="resize: none;" required></textarea>
                        <div class="invalid-feedback">Por favor, digite sua mensagem.</div>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-3">Enviar Mensagem</button>   
                </form>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>
