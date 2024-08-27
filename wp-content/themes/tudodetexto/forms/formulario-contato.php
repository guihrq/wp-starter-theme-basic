<section id="contato" class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h2><?php the_field('contato_title'); ?></h2>
                <p><?php the_field('contato_description'); ?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <form id="contactForm" class="form-hide" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" novalidate>
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
                    <button type="button" class="btn btn-primary mt-3" onclick="EnviaFormContato()">Enviar Mensagem</button>
                </form>
                <!-- Mensagem de sucesso inicialmente oculta -->
                <div id="successMessage" style="display: none;" class="alert alert-success">
                    Obrigado! Sua mensagem foi enviada com sucesso.
                </div>
            </div>
        </div>
    </div>
</section>