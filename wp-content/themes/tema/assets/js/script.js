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