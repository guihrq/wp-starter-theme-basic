<?php
/*
Template Name: Serviços
*/
get_header('fixed-dropdown'); ?>

<main class="container py-5">
    <header class="mb-5">
        <h1 class="text-center"><?php the_title(); ?></h1>
        <p class="text-center"><?php echo get_post_meta(get_the_ID(), 'subtitulo', true); ?></p>
    </header>

    <section class="row">
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Serviço 1</h3>
                    <p class="card-text">Descrição do Serviço 1.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Serviço 2</h3>
                    <p class="card-text">Descrição do Serviço 2.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Serviço 3</h3>
                    <p class="card-text">Descrição do Serviço 3.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Serviço 4</h3>
                    <p class="card-text">Descrição do Serviço 4.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
