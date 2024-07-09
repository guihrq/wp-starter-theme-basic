<?php get_header('fixed-dropdown'); ?>

<main class="container py-5">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="mb-4">
                            <h1 class="mb-3"><?php the_title(); ?></h1>
                            <div class="meta">
                                <span class="text-muted">Publicado em <?php echo get_the_date(); ?> por <?php the_author(); ?></span>
                                <span class="text-muted"> | Categoria: <?php the_category(', '); ?></span>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail mb-4">
                                <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid" alt="<?php the_title(); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>

                        <footer class="mt-4">
                            <div class="tags">
                                <?php the_tags('<span class="badge bg-primary me-1">', '</span><span class="badge bg-primary me-1">', '</span>'); ?>
                            </div>
                            <nav class="post-navigation mt-4">
                                <div class="d-flex justify-content-between">
                                    <div class="prev-post">
                                        <?php previous_post_link('%link', '<i class="fa fa-arrow-left"></i> Post Anterior'); ?>
                                    </div>
                                    <div class="next-post">
                                        <?php next_post_link('%link', 'Próximo Post <i class="fa fa-arrow-right"></i>'); ?>
                                    </div>
                                </div>
                            </nav>
                        </footer>
                    </article>
                <?php endwhile;
            else : ?>
                <p><?php esc_html_e('Desculpe, nenhum post encontrado.'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
