<?php get_header('fixed-dropdown'); ?>

<main class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="text-center">Últimos Posts</h1>
        </div>
        <div class="col-12">
            <?php if (have_posts()) : ?>
                <div class="carousel js-flickity" data-flickity-options='{ "cellAlign": "left", "contain": true, "wrapAround": true }'>
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                    );
                    $query = new WP_Query($args);
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="carousel-cell">
                            <div class="card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php the_title(); ?></h5>
                                    <p class="card-text"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Leia Mais</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <!-- Paginação -->
                <div class="pagination mt-4">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages
                    ));
                    ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e('Desculpe, nenhum post encontrado.'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Repetidor de Links das Categorias -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center">Categorias</h2>
            <div class="d-flex flex-wrap justify-content-center">
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    echo '<a href="' . get_category_link($category->term_id) . '" class="btn btn-outline-primary m-2">' . $category->name . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
