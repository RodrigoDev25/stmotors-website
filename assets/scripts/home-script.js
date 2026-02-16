// ================================
// LGPD - COOKIE CONSENT
// ================================
(function() {
  const COOKIE_CONSENT_KEY = 'stmotors_cookie_consent';
  const CONSENT_EXPIRY_DAYS = 365;

  function getCookieConsent() {
    try {
      const consent = localStorage.getItem(COOKIE_CONSENT_KEY);
      return consent ? JSON.parse(consent) : null;
    } catch (e) {
      console.error('Erro ao ler consentimento de cookies:', e);
      return null;
    }
  }

  function setCookieConsent(consent) {
    try {
      const consentData = {
        analytics: consent.analytics || false,
        marketing: consent.marketing || false,
        timestamp: Date.now(),
        expiry: Date.now() + (CONSENT_EXPIRY_DAYS * 24 * 60 * 60 * 1000)
      };
      localStorage.setItem(COOKIE_CONSENT_KEY, JSON.stringify(consentData));
    } catch (e) {
      console.error('Erro ao salvar consentimento de cookies:', e);
    }
  }

  function isConsentExpired(consent) {
    return !consent || !consent.expiry || Date.now() > consent.expiry;
  }

  function showCookieConsent() {
    const banner = document.getElementById('cookie-consent');
    if (banner) {
      banner.hidden = false;
    }
  }

  function hideCookieConsent() {
    const banner = document.getElementById('cookie-consent');
    if (banner) {
      banner.hidden = true;
    }
  }

  function initCookieConsent() {
    const consent = getCookieConsent();

    if (!consent || isConsentExpired(consent)) {
      showCookieConsent();
    }

    const acceptAllBtn = document.getElementById('cookie-accept-all');
    const acceptEssentialBtn = document.getElementById('cookie-accept-essential');

    if (acceptAllBtn) {
      acceptAllBtn.addEventListener('click', function() {
        setCookieConsent({ analytics: true, marketing: true });
        hideCookieConsent();
        // Aqui você carregaria Google Analytics, Facebook Pixel, etc.
        console.log('✅ Consentimento total concedido - Analytics e Marketing habilitados');
      });
    }

    if (acceptEssentialBtn) {
      acceptEssentialBtn.addEventListener('click', function() {
        setCookieConsent({ analytics: false, marketing: false });
        hideCookieConsent();
        console.log('✅ Apenas cookies essenciais habilitados');
      });
    }
  }

  // Executar ao carregar
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCookieConsent);
  } else {
    initCookieConsent();
  }
})();

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

document.querySelectorAll('.nav__link-mobile').forEach(link => {
  link.addEventListener('click', () => {
    if (mobileMenu && mobileMenu.classList.contains('active')) {
      toggleMenu();
    }
  });
});

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
    toggleMenu();
  }
});

// ================================
// HEADER SCROLL EFFECT
// ================================
const header = document.querySelector('.header');
let lastScroll = 0;
let ticking = false;

function updateHeader() {
  const currentScroll = window.pageYOffset;

  if (currentScroll > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }

  lastScroll = currentScroll;
  ticking = false;
}

window.addEventListener('scroll', () => {
  if (!ticking) {
    window.requestAnimationFrame(updateHeader);
    ticking = true;
  }
}, { passive: true });

// ================================
// ACTIVE LINK DETECTION
// ================================
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav__link, .nav__link-mobile');

function setActiveLink() {
  let current = '';

  sections.forEach(section => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;
    
    if (window.pageYOffset >= (sectionTop - 100)) {
      current = section.getAttribute('id');
    }
  });

  navLinks.forEach(link => {
    link.classList.remove('nav__link--active', 'nav__link-mobile--active');
    
    if (link.getAttribute('href') === `#${current}`) {
      if (link.classList.contains('nav__link-mobile')) {
        link.classList.add('nav__link-mobile--active');
      } else {
        link.classList.add('nav__link--active');
      }
    }
  });
}

let scrollTicking = false;

window.addEventListener('scroll', () => {
  if (!scrollTicking) {
    window.requestAnimationFrame(() => {
      setActiveLink();
      scrollTicking = false;
    });
    scrollTicking = true;
  }
}, { passive: true });

setActiveLink();

// ================================
// HERO SEARCH - Autocomplete
// ================================
const searchInput = document.getElementById('search-input');
const searchForm = document.querySelector('.hero__search');
const suggestionsContainer = document.getElementById('search-suggestions');

let debounceTimer;
let currentFocus = -1;

if (searchInput && suggestionsContainer) {
  searchInput.addEventListener('input', (e) => {
    clearTimeout(debounceTimer);
    const query = e.target.value.trim();

    if (query.length < 2) {
      hideSuggestions();
      return;
    }

    debounceTimer = setTimeout(() => {
      fetchSuggestions(query);
    }, 300);
  });

  searchInput.addEventListener('keydown', (e) => {
    if (!suggestionsContainer || suggestionsContainer.hidden) return;

    const items = suggestionsContainer.querySelectorAll('[role="option"]');

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      currentFocus++;
      addActive(items);
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      currentFocus--;
      addActive(items);
    } else if (e.key === 'Enter') {
      e.preventDefault();
      if (currentFocus > -1 && items[currentFocus]) {
        items[currentFocus].click();
      } else {
        searchForm.submit();
      }
    } else if (e.key === 'Escape') {
      hideSuggestions();
      searchInput.blur();
    }
  });
}

function fetchSuggestions(query) {
  try {
    // Mock data - Em produção, fazer chamada real à API
    const mockSuggestions = [
      { id: 1, name: 'Honda CG 160 Start', category: 'Motos', year: 2023 },
      { id: 2, name: 'Honda CB 500F', category: 'Motos', year: 2022 },
      { id: 3, name: 'Yamaha Fazer 250', category: 'Motos', year: 2023 },
      { id: 4, name: 'Yamaha MT-07', category: 'Motos', year: 2021 },
      { id: 5, name: 'Suzuki GSX-S 750', category: 'Motos', year: 2022 }
    ];

    const filtered = mockSuggestions.filter(item => 
      item.name.toLowerCase().includes(query.toLowerCase())
    );

    if (filtered.length > 0) {
      renderSuggestions(filtered);
    } else {
      hideSuggestions();
    }
  } catch (error) {
    console.error('Erro ao buscar sugestões:', error);
    hideSuggestions();
  }
}

function renderSuggestions(suggestions) {
  if (!suggestionsContainer) return;

  suggestionsContainer.innerHTML = '';
  currentFocus = -1;

  suggestions.forEach((item, index) => {
    const div = document.createElement('div');
    div.classList.add('hero__search-suggestion-item');
    div.setAttribute('role', 'option');
    div.setAttribute('id', `suggestion-${index}`);
    div.setAttribute('aria-selected', 'false');
    div.setAttribute('tabindex', '0');
    
    div.innerHTML = `
      <span class="suggestion-name">${escapeHtml(item.name)}</span>
      ${item.year ? `<span class="suggestion-year">${escapeHtml(String(item.year))}</span>` : ''}
    `;

    div.addEventListener('click', () => {
      searchInput.value = item.name;
      hideSuggestions();
      searchForm.submit();
    });

    div.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        div.click();
      }
    });

    suggestionsContainer.appendChild(div);
  });

  suggestionsContainer.hidden = false;
  searchInput.setAttribute('aria-expanded', 'true');
}

function hideSuggestions() {
  if (!suggestionsContainer) return;
  
  suggestionsContainer.hidden = true;
  suggestionsContainer.innerHTML = '';
  searchInput.setAttribute('aria-expanded', 'false');
  currentFocus = -1;
}

function addActive(items) {
  if (!items || items.length === 0) return;
  
  removeActive(items);
  
  if (currentFocus >= items.length) currentFocus = 0;
  if (currentFocus < 0) currentFocus = items.length - 1;
  
  items[currentFocus].classList.add('active');
  items[currentFocus].setAttribute('aria-selected', 'true');
  searchInput.setAttribute('aria-activedescendant', items[currentFocus].id);
  
  items[currentFocus].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
}

function removeActive(items) {
  items.forEach(item => {
    item.classList.remove('active');
    item.setAttribute('aria-selected', 'false');
  });
}

function escapeHtml(text) {
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, m => map[m]);
}

document.addEventListener('click', (e) => {
  if (suggestionsContainer && searchForm && !searchForm.contains(e.target)) {
    hideSuggestions();
  }
});

// ================================
// VIDEO BACKGROUND
// ================================
const heroVideo = document.querySelector('.hero__background-video');

if (heroVideo) {
  // Feature detection para IntersectionObserver
  if ('IntersectionObserver' in window) {
    const videoObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          heroVideo.play().catch(err => {
            console.log('Autoplay bloqueado pelo navegador:', err);
          });
        } else {
          heroVideo.pause();
        }
      });
    }, {
      threshold: 0.5
    });

    videoObserver.observe(heroVideo);
  } else {
    // Fallback: tentar reproduzir direto
    heroVideo.play().catch(err => {
      console.log('Autoplay bloqueado:', err);
    });
  }

  // Network-aware loading
  if ('connection' in navigator) {
    const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    if (connection) {
      const effectiveType = connection.effectiveType;
      if (effectiveType === 'slow-2g' || effectiveType === '2g') {
        heroVideo.remove();
        console.log('📱 Vídeo removido: conexão lenta detectada');
      }
    }
  }

  // Save data mode
  if ('connection' in navigator && navigator.connection.saveData) {
    heroVideo.remove();
    console.log('📱 Vídeo removido: modo economia de dados ativo');
  }
}

// ================================
// SMOOTH SCROLL
// ================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const targetId = this.getAttribute('href');
    
    if (targetId === '#' || targetId === '') return;
    
    const targetElement = document.querySelector(targetId);
    
    if (targetElement) {
      e.preventDefault();
      
      const headerOffset = parseInt(getComputedStyle(document.documentElement)
        .getPropertyValue('--header-height')) || 72;
      
      const elementPosition = targetElement.offsetTop;
      const offsetPosition = elementPosition - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      });

      // Melhorar acessibilidade: focar no elemento após scroll
      setTimeout(() => {
        targetElement.focus({ preventScroll: true });
      }, 500);
    }
  });
});

// ================================
// PERFORMANCE - IMAGE LAZY LOADING
// ================================
if ('loading' in HTMLImageElement.prototype) {
  const images = document.querySelectorAll('img[loading="lazy"]');
  images.forEach(img => {
    img.src = img.dataset.src || img.src;
  });
} else {
  // Fallback para navegadores antigos
  const script = document.createElement('script');
  script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
  document.body.appendChild(script);
}

// ================================
// CLEANUP
// ================================
window.addEventListener('beforeunload', () => {
  clearTimeout(debounceTimer);
});

// ================================
// ERROR HANDLING GLOBAL
// ================================
window.addEventListener('error', (e) => {
  console.error('Erro global capturado:', e.error);
  // Em produção, enviar para serviço de monitoramento
});

window.addEventListener('unhandledrejection', (e) => {
  console.error('Promise rejeitada não tratada:', e.reason);
  // Em produção, enviar para serviço de monitoramento
});

// ================================
// INIT
// ================================
function init() {
  console.log('🏍️ ST Motors - Sistema inicializado');
  console.log('📊 Performance:', {
    DOMContentLoaded: performance.now().toFixed(2) + 'ms'
  });
  
  setActiveLink();
  updateHeader();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}

// ================================
// WEB VITALS - MONITORING (Opcional)
// ================================
if ('PerformanceObserver' in window) {
  try {
    // Largest Contentful Paint
    const lcpObserver = new PerformanceObserver((list) => {
      const entries = list.getEntries();
      const lastEntry = entries[entries.length - 1];
      console.log('⚡ LCP:', lastEntry.renderTime || lastEntry.loadTime);
    });
    lcpObserver.observe({ type: 'largest-contentful-paint', buffered: true });

    // First Input Delay
    const fidObserver = new PerformanceObserver((list) => {
      const entries = list.getEntries();
      entries.forEach((entry) => {
        console.log('⚡ FID:', entry.processingStart - entry.startTime);
      });
    });
    fidObserver.observe({ type: 'first-input', buffered: true });

    // Cumulative Layout Shift
    let clsScore = 0;
    const clsObserver = new PerformanceObserver((list) => {
      list.getEntries().forEach((entry) => {
        if (!entry.hadRecentInput) {
          clsScore += entry.value;
          console.log('⚡ CLS:', clsScore);
        }
      });
    });
    clsObserver.observe({ type: 'layout-shift', buffered: true });
  } catch (e) {
    console.log('Web Vitals monitoring não disponível:', e);
  }
}
// ================================
// SHOWROOM FILTER TOGGLE (Mobile)
// ================================
const filterToggle = document.querySelector('.showroom__filter-toggle');
const filterPanel = document.getElementById('filter-panel');

if (filterToggle && filterPanel) {
  filterToggle.addEventListener('click', () => {
    const isExpanded = filterToggle.getAttribute('aria-expanded') === 'true';
    
    filterToggle.setAttribute('aria-expanded', !isExpanded);
    filterPanel.hidden = isExpanded;
  });
}

// ================================
// SHOWROOM FILTERS
// ================================
const filterCategory = document.getElementById('filter-category');
const filterPrice = document.getElementById('filter-price');
const filterEngine = document.getElementById('filter-engine');

function applyFilters() {
  const categoryValue = filterCategory ? filterCategory.value : '';
  const priceValue = filterPrice ? filterPrice.value : '';
  const engineValue = filterEngine ? filterEngine.value : '';

  // Em produção, fazer chamada à API com os filtros
  console.log('🔍 Filtros aplicados:', {
    category: categoryValue,
    price: priceValue,
    engine: engineValue
  });

  // Aqui você implementaria a lógica de filtragem
  // Por exemplo, ocultar/mostrar cards baseado nos filtros
}

if (filterCategory) {
  filterCategory.addEventListener('change', applyFilters);
}

if (filterPrice) {
  filterPrice.addEventListener('change', applyFilters);
}

if (filterEngine) {
  filterEngine.addEventListener('change', applyFilters);
}
// ================================
// TESTIMONIALS SLIDER
// ================================
(function() {
  const slider = document.getElementById('testimonials-slider');
  const prevBtn = document.getElementById('testimonials-prev');
  const nextBtn = document.getElementById('testimonials-next');
  const dotsContainer = document.getElementById('testimonials-dots');
  
  if (!slider || !prevBtn || !nextBtn || !dotsContainer) return;

  const cards = slider.querySelectorAll('.testimonial-card');
  let currentIndex = 0;
  let cardsPerView = getCardsPerView();

  // Detectar número de cards visíveis por viewport
  function getCardsPerView() {
    if (window.innerWidth >= 768) return 2;
    return 1;
  }

  // Criar dots de navegação
  function createDots() {
    dotsContainer.innerHTML = '';
    const totalDots = Math.ceil(cards.length / cardsPerView);
    
    for (let i = 0; i < totalDots; i++) {
      const dot = document.createElement('button');
      dot.classList.add('testimonial-dot');
      dot.setAttribute('type', 'button');
      dot.setAttribute('role', 'tab');
      dot.setAttribute('aria-label', `Ir para depoimento ${i + 1}`);
      dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
      
      if (i === 0) dot.classList.add('active');
      
      dot.addEventListener('click', () => goToSlide(i));
      dotsContainer.appendChild(dot);
    }
  }

  // Ir para slide específico
  function goToSlide(index) {
    const totalSlides = Math.ceil(cards.length / cardsPerView);
    currentIndex = Math.max(0, Math.min(index, totalSlides - 1));
    updateSlider();
  }

  // Atualizar posição do slider
  function updateSlider() {
    const cardWidth = cards[0].offsetWidth;
    const gap = parseInt(getComputedStyle(slider).gap) || 16;
    const offset = currentIndex * (cardWidth + gap) * cardsPerView;
    
    slider.style.transform = `translateX(-${offset}px)`;
    
    // Atualizar dots
    const dots = dotsContainer.querySelectorAll('.testimonial-dot');
    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === currentIndex);
      dot.setAttribute('aria-selected', i === currentIndex ? 'true' : 'false');
    });
    
    // Atualizar estado dos botões
    const totalSlides = Math.ceil(cards.length / cardsPerView);
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= totalSlides - 1;
  }

  // Navegação anterior
  function prevSlide() {
    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }
  }

  // Navegação próxima
  function nextSlide() {
    const totalSlides = Math.ceil(cards.length / cardsPerView);
    if (currentIndex < totalSlides - 1) {
      currentIndex++;
      updateSlider();
    }
  }

  // Event Listeners
  prevBtn.addEventListener('click', prevSlide);
  nextBtn.addEventListener('click', nextSlide);

  // Touch/Swipe support
  let touchStartX = 0;
  let touchEndX = 0;

  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  }, { passive: true });

  function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
      if (diff > 0) {
        nextSlide();
      } else {
        prevSlide();
      }
    }
  }

  // Keyboard navigation
  slider.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
      prevSlide();
      e.preventDefault();
    } else if (e.key === 'ArrowRight') {
      nextSlide();
      e.preventDefault();
    }
  });

  // Resize handler
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      const newCardsPerView = getCardsPerView();
      if (newCardsPerView !== cardsPerView) {
        cardsPerView = newCardsPerView;
        currentIndex = 0;
        createDots();
        updateSlider();
      }
    }, 150);
  });

  // Inicializar
  createDots();
  updateSlider();

  // Auto-play opcional (comentado, pode ser ativado)
  let autoplayInterval;
  function startAutoplay() {
    autoplayInterval = setInterval(() => {
      const totalSlides = Math.ceil(cards.length / cardsPerView);
      if (currentIndex >= totalSlides - 1) {
        currentIndex = 0;
      } else {
        currentIndex++;
      }
      updateSlider();
    }, 5000);
  }

  function stopAutoplay() {
    clearInterval(autoplayInterval);
  }

  startAutoplay();
  slider.addEventListener('mouseenter', stopAutoplay);
  slider.addEventListener('mouseleave', startAutoplay);
})();