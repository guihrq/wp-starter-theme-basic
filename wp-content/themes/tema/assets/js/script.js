jQuery(document).ready(function($) {
    $('#contactForm').submit(function(event) {
        // Previne o envio padrão do formulário
        event.preventDefault();

        // Validação dos campos
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();

        if (name.trim() === '') {
            alert('Por favor, preencha o campo Nome.');
            return;
        }

        if (email.trim() === '') {
            alert('Por favor, preencha o campo E-mail.');
            return;
        } else if (!isValidEmail(email)) {
            alert('Por favor, insira um endereço de e-mail válido.');
            return;
        }

        if (message.trim() === '') {
            alert('Por favor, preencha o campo Mensagem.');
            return;
        }

        // Se todos os campos forem válidos, envia o formulário
        submitForm();
    });

    // Função para validar o formato do e-mail
    function isValidEmail(email) {
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }

    // Função para enviar o formulário via AJAX
    function submitForm() {
        var formData = $('#contactForm').serialize();

        $.ajax({
            type: 'POST',
            url: '/wp-content/themes/seu-tema/formulario.php', // Altere o caminho conforme necessário
            data: formData,
            success: function(response) {
                // Trate a resposta conforme necessário
                console.log(response);
                alert('Formulário enviado com sucesso!');
                $('#contactForm')[0].reset(); // Limpa o formulário após o envio
            },
            error: function(error) {
                // Trate os erros de requisição
                console.error('Erro ao enviar formulário:', error);
                alert('Ocorreu um erro ao enviar o formulário. Por favor, tente novamente.');
            }
        });
    }
});

// Botão Voltar para o Topo
var btn = $('#button');
$(window).scroll(function() {
  if ($(window).scrollTop() > 2000) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

// Modal Cookies + Gravação
document.addEventListener('DOMContentLoaded', function() {
    const personalizarButton = document.querySelector('[data-lgpd-personalizar]'); // Seleciona o botão "Personalizar"
    const preferencesDiv = document.querySelector('.lgpd-preferences'); // Seleciona a div de preferências
    const salvarButton = document.querySelector('.lgpd-save'); // Seleciona o botão "Salvar"
    // Adiciona um evento de clique ao botão "Personalizar"
    personalizarButton.addEventListener('click', function() {
        if (preferencesDiv.classList.contains('open')) {
            preferencesDiv.classList.remove('open'); // Remove a classe 'open' se já estiver presente
            salvarButton.textContent = 'Continuar'; // Altera o texto do botão "Salvar" para "Continuar"
        } else {
            preferencesDiv.classList.add('open'); // Adiciona a classe 'open' se não estiver presente
            salvarButton.textContent = 'Salvar'; // Altera o texto do botão "Continuar" para "Salvar"
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Função para animar o switch (deve ser adaptada conforme a sua biblioteca de animação)
    function animateSwitch(switchElement) {
        // Exemplo de animação simples
        switchElement.classList.toggle('animated'); // Adicione/Remova uma classe de animação
    }
    // Estado inicial dos cookies (podem ser salvos no localStorage ou cookie)
    let cookiesPreferences = {
        essential: true, // Cookies essenciais sempre são aceitos
        analytics: false, // Estado inicial dos cookies de análise de uso do site
        ads: false // Estado inicial dos cookies de anúncios personalizados
    };
    // Função para atualizar o estado dos switches e aplicar animação
    function updateSwitchState(switchElement, isChecked) {
        switchElement.setAttribute('aria-checked', isChecked);
        animateSwitch(switchElement);
    }
    // Inicialização dos switches com base no estado atual dos cookies
    updateSwitchState(document.getElementById('switchAnalytics'), cookiesPreferences.analytics);
    updateSwitchState(document.getElementById('switchAds'), cookiesPreferences.ads);
    // Event listener para clique nos switches
    document.querySelectorAll('.lgpd-switch-toggle').forEach(function (switchToggle) {
        switchToggle.addEventListener('click', function () {
            let cookieType = this.getAttribute('data-lgpd-id');
            if (cookieType === 'analytics') {
                cookiesPreferences.analytics = !cookiesPreferences.analytics;
                updateSwitchState(this, cookiesPreferences.analytics);
            } else if (cookieType === 'ads') {
                cookiesPreferences.ads = !cookiesPreferences.ads;
                updateSwitchState(this, cookiesPreferences.ads);
            }
        });
    });
    // Event listener para o botão "Continuar"
    document.getElementById('btnContinuar').addEventListener('click', function () {
        // Salvar apenas os cookies essenciais (exemplo: salvar no localStorage)
        localStorage.setItem('cookiesPreferences', JSON.stringify({
            essential: true,
            analytics: false,
            ads: false
        }));
        console.log('Apenas cookies essenciais salvos:', cookiesPreferences);
        // Ocultar div.lgpd por 1 mês (30 dias)
        hidelgpdforPeriod(30); // 30 dias
        // Ou pode redirecionar o usuário para a página principal
        // window.location.href = '/';
    });
    // Event listener para o botão "Personalizar" (pode abrir um modal de personalização)
    document.getElementById('btnPersonalizar').addEventListener('click', function () {
        // Exemplo: abrir um modal de personalização
        console.log('Abrir modal de personalização');
    });
    // Lógica para ocultar div.lgpd por um período específico (em dias)
    function hidelgpdforPeriod(days) {
        const lgpdElement = document.querySelector('.lgpd');
        if (lgpdElement) {
            // Ocultar a div.lgpd
            lgpdElement.style.display = 'none';
            // Definir timeout para mostrar a div.lgpd novamente após o período especificado
            setTimeout(function () {
                lgpdElement.style.display = 'block'; // Voltar ao estilo padrão (possivelmente 'block' ou 'flex')
            }, days * 24 * 60 * 60 * 1000); // Converter dias para milissegundos
        }
    }
});
