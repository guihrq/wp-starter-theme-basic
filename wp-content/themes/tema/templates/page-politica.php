<?php
/*
Template Name: Política de Privacidade
*/
get_header('fixed-dropdown'); ?>

<main id="content" role="main">
    <section class="privacy-policy">
        <div class="container">
            <div class="row">
                <!-- Menu Lateral -->
                <div class="col-md-3">
                    <div class="menu-card card">
                        <div class="card-body">
                            <h2>Índice</h2>
                            <ul>
                                <li><a href="#coleta">1. Coleta de Dados</a></li>
                                <li><a href="#cookies">2. Cookies e Tecnologias de Rastreamento</a></li>
                                <li><a href="#finalidade">3. Finalidade dos Dados</a></li>
                                <ul>
                                    <li><a href="#funcionalidade">3.1 Funcionalidade e Manutenção da Plataforma</a></li>
                                    <li><a href="#performance">3.2 Performance e Estatística</a></li>
                                    <li><a href="#publicidade">3.3 Campanhas Publicitárias</a></li>
                                </ul>
                                <li><a href="#compartilhamento">4. Compartilhamento de Dados do Usuário</a></li>
                                <li><a href="#seguranca">5. Segurança</a></li>
                                <li><a href="#direitos">6. Direitos dos Usuários</a></li>
                                <ul>
                                    <li><a href="#opcoes">6.1 Opções quanto ao uso de seus dados</a></li>
                                    <li><a href="#acesso">6.2 Acesso, manutenção e exclusão de dados</a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Conteúdo Principal -->
                <div class="col-md-9">
                    <div class="content-card card">
                        <div class="card-body">
                            <?php
                            // Inicia o loop para a página atual
                            if (have_posts()) :
                                while (have_posts()) : the_post(); ?>
                                    <header class="mb-5 text-center">
                                        <h1><?php the_title(); ?></h1>
                                        <p><?php echo get_post_meta(get_the_ID(), 'subtitulo', true); ?></p>
                                    </header>
                                    <div class="card-text">
                                        <!-- Exibe o conteúdo da página com formatação HTML -->
                                        <p>Esta Política de Privacidade foi <em>atualizada em 00/00/202X</em></p>

                                        <p>Esta Política de Privacidade sumariza nossas práticas de coleta e tratamento de dados e descreve os direitos do usuário de acessar, corrigir ou limitar o uso de seus dados pessoais por parte da Organização.</p>

                                        <p>Esta Política de Privacidade se aplica quando o usuário visita ou usa o site.</p>

                                        <h1 id="coleta">1. Coleta de Dados</h1>
                                        <p>Coletamos alguns dados do usuário de <em>forma direta</em>, como informações inseridas pelo próprio usuário em nossos formulários e de <em>forma automatizada</em>, tais como informações sobre o dispositivo do usuário e com quais páginas do nosso site o usuário interage ou utiliza.</p>

                                        <h2 id="dados-diretos">1.1 Dados coletados diretamente:</h2>
                                        <p>Quando o usuário se registra através do nosso formulário e acessa nossa plataforma coletamos todos os dados fornecidos diretamente, entre eles:</p>
                                        <ul>
                                            <li><strong>Dados da conta:</strong> Para usar determinados recursos (como assinar um Plano), é necessário criar uma conta de usuário. Quando o usuário cria ou atualiza sua conta, coletamos e armazenamos os dados fornecidos, como nome completo, endereço físico, endereço de e-mail, senha e atribuímos ao usuário um número de identificação exclusivo (“Dados da conta”).</li>
                                            <li><strong>Dados dos cursos:</strong> Quando o usuário assina um Plano, coletamos alguns dados, como quais cursos foram iniciados e concluídos pelo usuário.</li>
                                            <li><strong>Dados sobre pagamento dos usuários:</strong> Quando o usuário assina um Plano, coletamos alguns dados sobre a compra em questão (tais como nome e CEP do usuário) quando necessário para processar o pedido. Cabe ao usuário fornecer determinados dados sobre pagamento e fatura diretamente aos nossos parceiros de processamento de pagamentos, entre eles nome do usuário, informações sobre o cartão de crédito, endereço de faturamento e CEP. Por questões de segurança, a Organização não coleta nem armazena dados confidenciais do titular do cartão, tais como o número completo do cartão de crédito ou os dados de autenticação do cartão.</li>
                                            <li><strong>Comunicações e suporte:</strong> Caso o usuário entre em contato para obter suporte ou relatar um problema ou dúvida (independentemente de ter criado uma conta), coletamos e armazenamos as informações de contato do usuário, bem como mensagens e outros dados sobre o usuário, tais como nome, endereço de e-mail, localização, sistema operacional, endereço IP e quaisquer outros dados que o usuário forneça ou que coletemos por meios automatizados (abordados abaixo). Estes dados serão usados para responder ao usuário e pesquisar sobre a dúvida apresentada, de acordo com esta Política de Privacidade.</li>
                                        </ul>
                                        <p>Os dados acima são armazenados pela Organização e associados à conta do usuário.</p>

                                        <h2 id="dados-automaticos">1.2 Dados coletados automaticamente:</h2>
                                        <p>Quando o usuário acessa o site coletamos determinados dados por meios automatizados, tais como:</p>
                                        <ul>
                                            <li><strong>Dados do sistema:</strong> Dados técnicos sobre o computador ou dispositivo do usuário, tais como endereço de IP, tipo de dispositivo, tipo e versão do sistema operacional, identificadores exclusivos do dispositivo, navegador, idioma do navegador, domínio e outros dados de sistemas e tipos de plataforma (“Dados do sistema”).</li>
                                            <li><strong>Dados sobre a utilização:</strong> Estatísticas de uso sobre as interações do usuário com o site, tais como cursos acessados, tempo gasto nas páginas, páginas visitadas, recursos utilizados, dados sobre os cliques, data e hora e outros dados relacionados ao uso dos Serviços (“Dados de uso”) por parte do usuário.</li>
                                            <li><strong>Dados geográficos aproximados:</strong> Localização geográfica aproximada, que inclui informações tais como país, cidade e coordenadas geográficas, calculada com base no endereço IP do usuário.</li>
                                        </ul>
                                        <p>Os dados listados acima são coletados por meio de arquivos de log do servidor e tecnologias de rastreamento.</p>
                                        <p>Os dados são armazenados pela Organização e associados à conta do usuário.</p>

                                        <h1 id="cookies">2. Forma de coleta dos dados:</h1>
                                        <p>Usamos cookies, serviços de análise e pixels de provedores de publicidade para reunir os dados citados.</p>
                                        <p>Algumas dessas ferramentas oferecem ao usuário a possibilidade de optar por não permitir a coleta de dados.</p>

                                        <h2 id="cookies-tecnologias">2.1 Cookies e ferramentas de coleta automatizadas</h2>
                                        <p>A Organização e os provedores de serviços que atuam em nome da organização (como o Google Analytics e anunciantes parceiros) usam cookies, tags, scripts, links personalizados, rastros de dispositivos ou navegadores para coleta automatizada de dados (coletivamente, <strong>“Ferramentas de coleta de dados”</strong>), quando o usuário acessa e usa o site.</p>
                                        <p>Utilizamos cookies (pequenos arquivos que os sites enviam ao dispositivo do usuário para identificar, de forma exclusiva, o navegador ou dispositivo do usuário ou para armazenar dados no navegador do usuário) para analisar o uso do site, personalizar a experiência do usuário, aprimorar a performance do site e reconhecer o usuário quando ele retornar. Usamos pixels (scripts que nos permitem medir as ações dos visitantes e usuários que utilizam o site) para identificar se uma página foi visitada e fazer anúncios de forma direcionada, excluindo usuários atuais de determinadas campanhas promocionais.</p>
                                        <p>A Organização usa os seguintes tipos de cookies:</p>
                                        <ul>
                                            <li><strong>Preferências:</strong> cookies que lembram dados sobre o navegador e as configurações preferenciais do usuário que afetam a aparência e o comportamento do site.</li>
                                            <li><strong>Segurança:</strong> cookies usadas para permitir que o usuário se conecte e acesse o site, proteger contra acessos fraudulentos e ajudar a detectar e impedir abuso ou uso não autorizado da conta do usuário.</li>
                                            <li><strong>Funcional:</strong> cookies que armazenam configurações funcionais (como o número de aulas completadas).</li>
                                            <li><strong>Estado da sessão:</strong> cookies que rastreiam as interações do usuário com o site para nos ajudar a melhorar o site e a experiência de navegação do usuário, lembrar os detalhes de acesso do usuário e permitir o processamento das compras de Planos. Estas são estritamente necessárias para que o site funcione corretamente. Portanto, se o usuário as desativar, não será possível acessar determinadas funcionalidades.</li>
                                        </ul>
                                        <p>O usuário pode ajustar as preferências do navegador para desativar cookies ou para notificá-lo quando um cookie for definido. No entanto, se o usuário desativar os cookies, pode não conseguir acessar todas as funcionalidades do site.</p>

                                        <h2 id="pixels-rastreamento">2.2 Pixels e tecnologias de rastreamento</h2>
                                        <p>Usamos pixels e tags de rastreamento para coletar dados sobre a navegação do usuário em nosso site. Estas ferramentas são usadas para analisar e melhorar a performance do site e fornecer campanhas publicitárias direcionadas. O usuário pode desativar pixels e outras tecnologias de rastreamento por meio de configurações específicas no navegador ou optando por não permitir cookies publicitários.</p>

                                        <h1 id="finalidade">3. Finalidade dos Dados</h1>
                                        <p>Usamos os dados coletados para diversos propósitos, conforme detalhado abaixo:</p>
                                        <ul>
                                            <li><strong>Funcionalidade e Manutenção da Plataforma:</strong> Usamos dados para garantir que o site funcione corretamente, proporcionar uma experiência de navegação personalizada e realizar a manutenção necessária.</li>
                                            <li><strong>Performance e Estatística:</strong> Coletamos e analisamos dados para avaliar a performance do site, entender o comportamento dos usuários e melhorar nossos serviços.</li>
                                            <li><strong>Campanhas Publicitárias:</strong> Usamos dados para oferecer campanhas publicitárias direcionadas, melhorar a eficácia das campanhas e fornecer anúncios relevantes.</li>
                                        </ul>

                                        <h2 id="funcionalidade">3.1 Funcionalidade e Manutenção da Plataforma</h2>
                                        <p>Os dados colhidos quando o usuário utiliza o site são usados para garantir que a plataforma funcione corretamente e para manter a experiência do usuário.</p>

                                        <h2 id="performance">3.2 Performance e Estatística</h2>
                                        <p>Usamos serviços de análise de terceiros para coletar dados de uso e avaliar a performance do site. Isso nos ajuda a entender como o site é utilizado e a identificar áreas para melhorias.</p>

                                        <h2 id="publicidade">3.3 Campanhas Publicitárias</h2>
                                        <p>Usamos dados para criar campanhas publicitárias personalizadas e relevantes. Isso inclui a exibição de anúncios direcionados com base no comportamento de navegação do usuário.</p>

                                        <h1 id="compartilhamento">4. Compartilhamento de Dados do Usuário</h1>
                                        <p>Compartilhamos alguns dados sobre o usuário com empresas que prestam serviços para a Organização, tais como provedores de pagamento, empresas de análise e parceiros de publicidade.</p>

                                        <h1 id="seguranca">5. Segurança</h1>
                                        <p>Adotamos medidas de segurança adequadas para proteger os dados pessoais dos usuários contra acesso não autorizado, perda ou divulgação.</p>

                                        <h1 id="direitos">6. Direitos dos Usuários</h1>
                                        <p>Os usuários têm direitos sobre seus dados pessoais, incluindo o direito de acessar, corrigir ou excluir seus dados. Para exercer esses direitos, o usuário deve entrar em contato conosco conforme descrito abaixo.</p>

                                        <h2 id="opcoes">6.1 Opções quanto ao uso de seus dados</h2>
                                        <ul>
                                            <li>O usuário pode optar por não fornecer determinados dados à Organização, mas isso pode afetar a capacidade de utilizar todos os recursos da plataforma.</li>
                                        </ul>

                                        <h2 id="acesso">6.2 Acesso, manutenção e exclusão de dados</h2>
                                        <ul>
                                            <li>Para atualizar dados fornecidos diretamente, o usuário deve conectar-se à sua conta e fazer as alterações necessárias.</li>
                                        </ul>

                                        <p>Ao utilizar nossos serviços, o <strong>usuário concorda com os termos</strong> desta Política de Privacidade.</p>

                                        <p>Não use os Serviços caso não concorde com esta Política de Privacidade.</p>
                                <?php endwhile; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
