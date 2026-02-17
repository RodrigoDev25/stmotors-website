// ================================
// LGPD - COOKIE CONSENT
// ================================
(function () {
  'use strict';

  const COOKIE_KEY = 'stmotors_consent';
  const EXPIRY_DAYS = 365;

  function getConsent() {
    const match = document.cookie.match('(?:^|; )' + COOKIE_KEY + '=([^;]*)');
    if (!match) return null;
    try { return JSON.parse(decodeURIComponent(match[1])); } catch { return null; }
  }

  function setConsent(data) {
    const expiry = new Date(Date.now() + EXPIRY_DAYS * 864e5).toUTCString();
    const value = encodeURIComponent(JSON.stringify({
      analytics: data.analytics || false,
      marketing: data.marketing || false,
      timestamp: Date.now()
    }));
    document.cookie = `${COOKIE_KEY}=${value}; expires=${expiry}; path=/; SameSite=Lax; Secure`;
  }

  function initCookieConsent() {
    const consent = getConsent();
    const banner = document.getElementById('cookie-consent');

    if (!consent && banner) banner.hidden = false;

    const acceptAll = document.getElementById('cookie-accept-all');
    const acceptEssential = document.getElementById('cookie-accept-essential');

    if (acceptAll) {
      acceptAll.addEventListener('click', function () {
        setConsent({ analytics: true, marketing: true });
        if (banner) banner.hidden = true;
      });
    }

    if (acceptEssential) {
      acceptEssential.addEventListener('click', function () {
        setConsent({ analytics: false, marketing: false });
        if (banner) banner.hidden = true;
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCookieConsent);
  } else {
    initCookieConsent();
  }
})();

// ================================
// MOBILE MENU + HEADER SCROLL
// ================================
(function () {
  'use strict';

  const menuToggle = document.querySelector('.header__menu-toggle');
  const mobileMenu = document.querySelector('.header__nav-mobile');
  const overlay = document.querySelector('.header__overlay');
  const header = document.querySelector('.header');
  const body = document.body;

  function toggleMenu() {
    if (!menuToggle || !mobileMenu || !overlay) return;

    const isOpen = menuToggle.classList.contains('active');

    menuToggle.classList.toggle('active');
    mobileMenu.classList.toggle('active');
    overlay.classList.toggle('active');

    body.style.overflow = isOpen ? '' : 'hidden';
    menuToggle.setAttribute('aria-expanded', String(!isOpen));
    menuToggle.setAttribute('aria-label', isOpen ? 'Abrir menu de navegação' : 'Fechar menu de navegação');
  }

  if (menuToggle) menuToggle.addEventListener('click', toggleMenu);
  if (overlay) overlay.addEventListener('click', toggleMenu);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
      toggleMenu();
    }
  });

  // ================================
  // MOBILE MENU - ACTIVE LINK
  // ================================
  const mobileLinks = document.querySelectorAll('.nav__link-mobile');

  mobileLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      mobileLinks.forEach(l => l.classList.remove('nav__link-mobile--active'));
      this.classList.add('nav__link-mobile--active');

      const href = this.getAttribute('href');

      if (href && href.startsWith('#')) {
        e.preventDefault();

        const targetSection = document.getElementById(href.substring(1));

        if (targetSection) {
          if (mobileMenu && mobileMenu.classList.contains('active')) toggleMenu();

          const headerHeight = header ? header.offsetHeight : 64;

          window.scrollTo({
            top: targetSection.offsetTop - headerHeight,
            behavior: 'smooth'
          });

          if (history.pushState) history.pushState(null, null, href);
        }
      } else {
        if (mobileMenu && mobileMenu.classList.contains('active')) toggleMenu();
      }
    });
  });

  // ================================
  // HEADER SCROLL EFFECT
  // ================================
  let ticking = false;

  function updateHeader() {
    if (!header) return;
    header.classList.toggle('scrolled', window.pageYOffset > 50);
    ticking = false;
  }

  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(updateHeader);
      ticking = true;
    }
  }, { passive: true });

})();