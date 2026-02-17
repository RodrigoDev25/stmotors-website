// ================================
// MOBILE MENU TOGGLE
// ================================
const menuToggle = document.querySelector('.header__menu-toggle');
const mobileMenu = document.querySelector('.header__nav-mobile');
const overlay = document.querySelector('.header__overlay');
const body = document.body;

function toggleMenu() {
  const isOpen = menuToggle.classList.contains('active');
  
  menuToggle.classList.toggle('active');
  mobileMenu.classList.toggle('active');
  overlay.classList.toggle('active');
  
  body.style.overflow = isOpen ? '' : 'hidden';
  
  menuToggle.setAttribute('aria-expanded', !isOpen);
  menuToggle.setAttribute('aria-label', isOpen ? 'Abrir menu de navegação' : 'Fechar menu de navegação');
}

if (menuToggle) {
  menuToggle.addEventListener('click', toggleMenu);
}

if (overlay) {
  overlay.addEventListener('click', toggleMenu);
}

// Fechar menu ao clicar em link
document.querySelectorAll('.nav__link-mobile').forEach(link => {
  link.addEventListener('click', () => {
    if (mobileMenu && mobileMenu.classList.contains('active')) {
      toggleMenu();
    }
  });
});

// Fechar menu com tecla Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
    toggleMenu();
  }
});

// ================================
// WHATSAPP FLUTUANTE - Comportamento Inteligente
// Esconde quando usuário chega na seção CTA final
// ================================

(function() {
  'use strict';

  // Elementos
  const floatButton = document.getElementById('whatsapp-float');
  const ctaSection = document.querySelector('.cta-final-section');
  
  if (!floatButton || !ctaSection) {
    console.warn('WhatsApp Float: Elementos não encontrados');
    return;
  }

  // Configurações
  const OFFSET_THRESHOLD = 150; // Pixels antes da seção CTA para esconder
  
  // Observer para detectar quando CTA entra no viewport
  let isCtaVisible = false;
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      isCtaVisible = entry.isIntersecting;
      toggleButton();
    });
  }, {
    threshold: 0.3, // 30% da seção visível
    rootMargin: `${OFFSET_THRESHOLD}px 0px 0px 0px`
  });

  // Função para mostrar/esconder botão
  function toggleButton() {
    if (isCtaVisible) {
      floatButton.classList.add('hidden');
      floatButton.setAttribute('aria-hidden', 'true');
    } else {
      floatButton.classList.remove('hidden');
      floatButton.setAttribute('aria-hidden', 'false');
    }
  }

  // Inicializar observer
  observer.observe(ctaSection);

  // Fallback para navegadores sem IntersectionObserver
  if (!('IntersectionObserver' in window)) {
    console.warn('IntersectionObserver não suportado. Usando fallback de scroll.');
    
    let ticking = false;
    
    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          checkScrollPosition();
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
    
    function checkScrollPosition() {
      const ctaRect = ctaSection.getBoundingClientRect();
      const windowHeight = window.innerHeight;
      
      // Se o topo da seção CTA está a 150px ou menos da parte inferior da tela
      if (ctaRect.top <= windowHeight - OFFSET_THRESHOLD) {
        floatButton.classList.add('hidden');
        floatButton.setAttribute('aria-hidden', 'true');
      } else {
        floatButton.classList.remove('hidden');
        floatButton.setAttribute('aria-hidden', 'false');
      }
    }
  }

  // Log para debug
  console.log('✅ WhatsApp Float inicializado');

})();



