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
                                    <div class="text-center mb-4">
                                        <img src="<?php the_sub_field('img_depoente'); ?>" alt="" class="img-fluid">
                                    </div>
                                    <p class="card-text"><?php the_sub_field('depoimento_text'); ?></p>
                                    <h5 class="card-title text-center"><?php the_sub_field('depoimento_author'); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>