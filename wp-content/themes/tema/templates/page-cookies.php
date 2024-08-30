<?php
/*
Template Name: Política de Cookies
*/
get_header('fixed-dropdown'); ?>

<main class="container mt-5 py-5">
    <header class="mb-5">
        <h1 class="text-center"><?php the_title(); ?></h1>
        <p class="text-center"><?php echo get_post_meta(get_the_ID(), 'subtitulo', true); ?></p>
    </header>

    <section class="row">
        <div class="col-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <?php
                    // Inicia o loop para a página atual
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); ?>
                            <!-- Exibe o conteúdo da página -->
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            <div class="card-text">
                                <div class="accordion" id="accordionExample">
                                    <!-- Seção 1: O que são Cookies? -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                O que são Cookies?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                                            <div class="accordion-body">
                                                Cookies são pequenos arquivos de texto armazenados no seu dispositivo quando você visita um site. Eles ajudam os sites a lembrar informações sobre sua visita, como suas preferências e ações passadas. Aqui estão alguns tipos comuns de cookies:
                                                <ul>
                                                    <li><strong>Cookies de Sessão:</strong> Armazenam informações temporárias durante uma sessão de navegação e são apagados quando o navegador é fechado.</li>
                                                    <li><strong>Cookies Persistentes:</strong> Permanecem no dispositivo por um período definido e são usados para lembrar preferências entre visitas.</li>
                                                    <li><strong>Cookies de Primeiro-Classe:</strong> Definidos pelo próprio site que você está visitando.</li>
                                                    <li><strong>Cookies de Terceiros:</strong> Definidos por domínios diferentes do site que você está visitando, frequentemente usados para publicidade e análises.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Seção 2: Como Usamos Cookies -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Como Usamos Cookies
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                            <div class="accordion-body">
                                                Utilizamos cookies para várias finalidades:
                                                <ul>
                                                    <li><strong>Funcionalidade:</strong> Para garantir que o site funcione corretamente, como manter você logado em sua conta.</li>
                                                    <li><strong>Desempenho:</strong> Para analisar como o site é usado e identificar áreas para melhoria.</li>
                                                    <li><strong>Publicidade:</strong> Para exibir anúncios relevantes com base em seu comportamento de navegação.</li>
                                                    <li><strong>Analytics:</strong> Para coletar dados sobre o tráfego e o comportamento dos usuários no site.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Seção 3: Tipos de Cookies Utilizados -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Tipos de Cookies Utilizados
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                                            <div class="accordion-body">
                                                Os tipos de cookies que utilizamos incluem:
                                                <ul>
                                                    <li><strong>Cookies Estritamente Necessários:</strong> Essenciais para o funcionamento do site, como gerenciamento de sessões.</li>
                                                    <li><strong>Cookies de Desempenho:</strong> Coletam dados sobre como você interage com o site.</li>
                                                    <li><strong>Cookies Funcionais:</strong> Lembram-se das suas preferências e configurações.</li>
                                                    <li><strong>Cookies de Publicidade:</strong> Exibem anúncios relevantes com base em seu comportamento.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Seção 4: Como Gerenciar Cookies -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Como Gerenciar Cookies
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                                            <div class="accordion-body">
                                                Você pode gerenciar cookies através das configurações do seu navegador. Aqui estão as instruções para alguns navegadores populares:
                                                <div class="list-group">
                                                    <a href="https://support.google.com/chrome/answer/95647" class="list-group-item list-group-item-action" target="_blank">
                                                        <strong>Google Chrome:</strong> Vá para "Configurações" > "Privacidade e segurança" > "Cookies e outros dados do site".
                                                    </a>
                                                    <a href="https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences" class="list-group-item list-group-item-action" target="_blank">
                                                        <strong>Mozilla Firefox:</strong> Vá para "Opções" > "Privacidade e Segurança" > "Cookies e Dados de Sites".
                                                    </a>
                                                    <a href="https://support.apple.com/en-us/HT201265" class="list-group-item list-group-item-action" target="_blank">
                                                        <strong>Safari:</strong> Vá para "Preferências" > "Privacidade" > "Gerenciar Dados de Sites".
                                                    </a>
                                                    <a href="https://support.microsoft.com/en-us/help/4468242/windows-10-how-to-delete-cookies" class="list-group-item list-group-item-action" target="_blank">
                                                        <strong>Microsoft Edge:</strong> Vá para "Configurações" > "Privacidade, pesquisa e serviços" > "Cookies e permissões de site".
                                                    </a>
                                                </div>
                                                Observe que a desativação de cookies pode afetar a funcionalidade de alguns recursos do site.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Seção 5: Alterações na Política de Cookies -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Alterações na Política de Cookies
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                                            <div class="accordion-body">
                                                Nossa Política de Cookies pode ser atualizada periodicamente para refletir alterações em nossas práticas e em conformidade com as leis aplicáveis. Recomendamos que você revise esta política regularmente para estar informado sobre como usamos cookies e outras tecnologias de rastreamento.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Seção 6: Contato -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                Contato
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix">
                                            <div class="accordion-body">
                                                Se você tiver dúvidas ou preocupações sobre nossa Política de Cookies, entre em contato conosco:
                                                <ul>
                                                    <li><strong>Por e-mail:</strong> [seu-email@dominio.com]</li>
                                                    <li><strong>Por telefone:</strong> [Seu Telefone]</li>
                                                    <li><strong>Endereço:</strong> [Seu Endereço Completo]</li>
                                                </ul>
                                                Responderemos às suas perguntas o mais breve possível.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botão Fechar Todos -->
                                <div class="text-end mt-3">
                                    <button class="btn btn-secondary" id="closeAllButton">Fechar Todos</button>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
