// jQuery Mask para o campo de telefone
jQuery(document).ready(function($) {
  $('#telefone').mask('(00) 0000-00000');
});

// Validação básica do formulário usando jQuery
jQuery(document).ready(function($) {
  $('#contactForm').submit(function(event) {
      if (this.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
      }
      $(this).addClass('was-validated');
  });
});