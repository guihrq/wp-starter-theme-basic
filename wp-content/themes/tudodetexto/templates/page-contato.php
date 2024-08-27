<?php
/**
 * Template Name: Contato
 */

get_header('fixed-dropdown'); ?>

<div class="container mt-5">
    <section id="contato" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_field('contato_title'); ?></h2>
                <p><?php the_field('contato_description'); ?></p>
                
                <form id="contatoForm" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>

                <div id="formResponse" class="mt-3"></div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
