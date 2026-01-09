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
  
  // Prevenir scroll no body quando menu aberto
  body.style.overflow = isOpen ? '' : 'hidden';
  
  // Atualizar ARIA para acessibilidade
  menuToggle.setAttribute('aria-expanded', !isOpen);
  menuToggle.setAttribute('aria-label', isOpen ? 'Abrir menu de navegação' : 'Fechar menu de navegação');
}

// Event Listeners
menuToggle.addEventListener('click', toggleMenu);
overlay.addEventListener('click', toggleMenu);

// Fechar menu ao clicar em link
document.querySelectorAll('.nav__link-mobile').forEach(link => {
  link.addEventListener('click', () => {
    if (mobileMenu.classList.contains('active')) {
      toggleMenu();
    }
  });
});

// Fechar menu ao pressionar ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
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

// Throttle para performance
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

// Execução inicial
setActiveLink();