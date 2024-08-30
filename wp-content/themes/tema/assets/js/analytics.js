/* ==================================== COOKIES ==================================== */

document.addEventListener('DOMContentLoaded', function () {
  const personalizarButton = document.querySelector('[data-lgpd-personalizar]');
  const preferencesDiv = document.querySelector('.lgpd-preferences');
  const salvarButton = document.querySelector('.lgpd-save');

  // Função para animar o switch
  function animateSwitch(switchElement) {
      switchElement.classList.toggle('animated');
  }

  // Função para definir um cookie
  function setCookie(name, value, daysToExpire) {
      let expirationDate = '';
      if (daysToExpire) {
          const date = new Date();
          date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
          expirationDate = `; expires=${date.toUTCString()}`;
      }
      document.cookie = `${name}=${value}${expirationDate}; path=/`;
  }

  // Função para obter o valor de um cookie por nome
  function getCookie(name) {
      const cookieName = `${name}=`;
      const decodedCookie = decodeURIComponent(document.cookie);
      const cookieArray = decodedCookie.split(';');
      for (let i = 0; i < cookieArray.length; i++) {
          let cookie = cookieArray[i].trim();
          if (cookie.indexOf(cookieName) === 0) {
              return cookie.substring(cookieName.length, cookie.length);
          }
      }
      return '';
  }

  // Estado inicial dos cookies (verifica se há preferências salvas)
  let cookiesPreferences = {
      essential: true,
      analytics: false,
      ads: false
  };

  // Atualiza os switches com base nos cookies existentes
  function updateSwitchesFromCookies() {
      cookiesPreferences.analytics = getCookie('analytics') === 'true';
      cookiesPreferences.ads = getCookie('ads') === 'true';

      updateSwitchState(document.getElementById('switchAnalytics'), cookiesPreferences.analytics);
      updateSwitchState(document.getElementById('switchAds'), cookiesPreferences.ads);
  }

  // Função para atualizar o estado dos switches e aplicar animação
  function updateSwitchState(switchElement, isChecked) {
      switchElement.setAttribute('aria-checked', isChecked);
      animateSwitch(switchElement);
  }

  // Inicialização dos switches com base no estado atual dos cookies
  updateSwitchesFromCookies();

  // Event listener para clique nos switches
  document.querySelectorAll('.lgpd-switch-toggle').forEach(function (switchToggle) {
      switchToggle.addEventListener('click', function () {
          let cookieType = this.getAttribute('data-lgpd-id');
          if (cookieType === 'analytics') {
              cookiesPreferences.analytics = !cookiesPreferences.analytics;
              setCookie('analytics', cookiesPreferences.analytics, 30); // Define o cookie 'analytics' com expiração de 30 dias
              updateSwitchState(this, cookiesPreferences.analytics);
          } else if (cookieType === 'ads') {
              cookiesPreferences.ads = !cookiesPreferences.ads;
              setCookie('ads', cookiesPreferences.ads, 30); // Define o cookie 'ads' com expiração de 30 dias
              updateSwitchState(this, cookiesPreferences.ads);
          }
      });
  });

  // Event listener para o botão "Continuar"
  document.getElementById('btnContinuar').addEventListener('click', function () {
      // Salvar todos os cookies preferences no localStorage
      localStorage.setItem('cookiesPreferences', JSON.stringify(cookiesPreferences));

      // Salvar cookies específicos
      saveSpecificCookies();

      console.log('Preferências de cookies salvas:', cookiesPreferences);

      // Ocultar div.lgpd por 30 dias
      hidelgpdforPeriod(30);
  });

  // Event listener para o botão "Personalizar"
  personalizarButton.addEventListener('click', function () {
      if (preferencesDiv.classList.contains('open')) {
          preferencesDiv.classList.remove('open');
          salvarButton.textContent = 'Continuar';
      } else {
          preferencesDiv.classList.add('open');
          salvarButton.textContent = 'Salvar';
      }
  });

  // Lógica para salvar cookies específicos
  function saveSpecificCookies() {
      const specificCookies = [
          'PHPSESSID', 'JSESSIONID', 'auth', 'token', 'NID', 'OGP', 'OGPC', 'SAPISID', 'SEARCH_SAMESITE',
          'SIDCC', 'SSID', '_GRECAPTCHA', '__Secure-1PAPISID', '__Secure-1PSID', '__Secure-1PSIDCC',
          '__Secure-1PSIDTS', '__Secure-3PAPISID', '__Secure-3PSID', '__Secure-3PSIDCC', '__Secure-3PSIDTS', 'io'
      ];
      specificCookies.forEach(cookie => {
          const cookieValue = getCookie(cookie);
          if (cookieValue !== '') {
              localStorage.setItem(cookie, cookieValue);
              sessionStorage.setItem(cookie, cookieValue);
          }
      });
  }

  // Lógica para ocultar div.lgpd por um período específico (em dias)
  function hidelgpdforPeriod(days) {
      const lgpdElement = document.querySelector('.lgpd');
      if (lgpdElement) {
          lgpdElement.style.display = 'none';
          setTimeout(function () {
              lgpdElement.style.display = 'none';
          }, days * 24 * 60 * 60 * 1000);
      }
  }
});