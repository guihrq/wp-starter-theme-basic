<!-- BLOG TEMPLATE -->
<?php get_header('fixed-dropdown'); ?>

    <section class="container d-md-flex align-items-stretch lista-posts">
        <div class="content">
            <div class="container">
                <h2>Blog</h2>
                <div class="row pt-5">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php
                            global $post;
                            $post_slug = $post->post_name;
                        ?>
                        <div class="col-sm-6 pb-3 pt-1">
                            <div class="col-sm-10">
                                <img src="<?php the_field('banner_post'); ?>" alt="">
                            </div>
                            <div class="col-sm-10 px-1 pt-1">
                                <p class="px-1"><?php echo date("d/m/Y"); ?></p>
                                <h3><a href="/blog/<?php echo $post_slug; ?>"><?php the_title(); ?></a></h3>
                                <cite><b>por:</b> <?php the_field('citacao'); ?></cite>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <?php get_sidebar(); ?>
    </section>
    
    <section class="container d-md-flex align-items-stretch paginacao">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 pt-5 mb-5 text-center">
                        <?php if (function_exists('pagination_funtion')) pagination_funtion(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php else: endif; ?>
    
<?php get_footer(); ?>