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

// Script para Fechar Todos os Itens
document.addEventListener('DOMContentLoaded', function () {
    var closeAllButton = document.getElementById('closeAllButton');
    closeAllButton.addEventListener('click', function () {
        var accordions = document.querySelectorAll('.accordion-collapse.show');
        accordions.forEach(function (accordion) {
            var bsCollapse = new bootstrap.Collapse(accordion, {toggle: false});
            bsCollapse.hide();
        });
    });
});

$(document).ready(function() {
    // Aplicar a máscara ao campo de telefone
    $('#telefone').mask('(00) 00000-0000');

    // Define a função EnviaFormContato
    window.EnviaFormContato = function() {
        // Desabilita o botão para evitar múltiplos envios
        var button = $('#contactForm button');
        button.prop('disabled', true);

        // Obtém o formulário e seus valores
        var form = $('#contactForm');
        var nome = $('#nome').val().trim();
        var email = $('#email').val().trim();
        var telefone = $('#telefone').val().trim();
        var mensagem = $('#mensagem').val().trim();

        // Define uma flag para verificar se o formulário é válido
        var isValid = true;

        // Remove mensagens de erro anteriores
        $('.invalid-feedback').hide();

        // Validação do nome
        if (!nome) {
            $('#nome').next('.invalid-feedback').show();
            isValid = false;
        }

        // Validação do e-mail
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailRegex.test(email)) {
            $('#email').next('.invalid-feedback').show();
            isValid = false;
        }

        // Validação do telefone
        var telefoneRegex = /^\(\d{2}\)\s\d{5}-\d{4}$/;
        if (!telefone || !telefoneRegex.test(telefone)) {
            $('#telefone').next('.invalid-feedback').show();
            isValid = false;
        }

        // Validação da mensagem
        if (!mensagem) {
            $('#mensagem').next('.invalid-feedback').show();
            isValid = false;
        }

        if (!isValid) {
            // Reabilita o botão se houver erro
            button.prop('disabled', false);
            return; // Se o formulário não for válido, não faz o envio
        }

        // Se o formulário for válido, envie os dados usando AJAX
        var serializedData = form.serialize(); // Serializa os dados do formulário

        $.ajax({
            type: 'POST',
            url: '/wp-content/themes/tema/formulario-contato.php',
            data: serializedData,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Oculta o formulário e mostra a mensagem de sucesso
                    $('#contactForm').hide();
                    $('#successMessage').show();
                } else {
                    alert('Ocorreu um erro ao enviar a mensagem.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar o formulário:', error);
                alert('Ocorreu um erro inesperado.');
            },
            complete: function() {
                // Reabilita o botão para permitir novas tentativas
                button.prop('disabled', false);
            }
        });
    };
});