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