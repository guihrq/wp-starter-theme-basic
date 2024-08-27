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
            url: '/wp-content/themes/tudodetexto/formulario-contato.php',
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