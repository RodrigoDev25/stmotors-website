(function () {
  'use strict';

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
        } else if (searchForm) {
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
      const mockSuggestions = [
        { id: 1, name: 'Honda CG 160 Start', year: 2023 },
        { id: 2, name: 'Honda CB 500F', year: 2022 },
        { id: 3, name: 'Yamaha Fazer 250', year: 2023 },
        { id: 4, name: 'Yamaha MT-07', year: 2021 },
        { id: 5, name: 'Suzuki GSX-S 750', year: 2022 }
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
        if (searchForm) searchForm.submit();
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
  // SMOOTH SCROLL
  // ================================
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');

      if (targetId === '#' || targetId === '') return;

      if (!/^#[a-zA-Z0-9_-]+$/.test(targetId)) return;

      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        e.preventDefault();

        const headerOffset = parseInt(getComputedStyle(document.documentElement)
          .getPropertyValue('--header-height')) || 72;

        const offsetPosition = targetElement.offsetTop - headerOffset;

        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });

        setTimeout(() => {
          targetElement.focus({ preventScroll: true });
        }, 500);
      }
    });
  });

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

    console.log('Filtros aplicados:', { category: categoryValue, price: priceValue, engine: engineValue });
  }

  if (filterCategory) filterCategory.addEventListener('change', applyFilters);
  if (filterPrice) filterPrice.addEventListener('change', applyFilters);
  if (filterEngine) filterEngine.addEventListener('change', applyFilters);

  // ================================
  // CLEANUP
  // ================================
  window.addEventListener('beforeunload', () => {
    clearTimeout(debounceTimer);
  });

})();

// ================================
// TESTIMONIALS SLIDER
// ================================
(function () {
  const slider = document.getElementById('testimonials-slider');
  const prevBtn = document.getElementById('testimonials-prev');
  const nextBtn = document.getElementById('testimonials-next');
  const dotsContainer = document.getElementById('testimonials-dots');

  if (!slider || !prevBtn || !nextBtn || !dotsContainer) return;

  const cards = slider.querySelectorAll('.testimonial-card');
  let currentIndex = 0;
  let cardsPerView = getCardsPerView();

  function getCardsPerView() {
    return window.innerWidth >= 768 ? 2 : 1;
  }

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

  function goToSlide(index) {
    const totalSlides = Math.ceil(cards.length / cardsPerView);
    currentIndex = Math.max(0, Math.min(index, totalSlides - 1));
    updateSlider();
  }

  function updateSlider() {
    const cardWidth = cards[0].offsetWidth;
    const gap = parseInt(getComputedStyle(slider).gap) || 16;
    const offset = currentIndex * cardsPerView * (cardWidth + gap);

    slider.style.transform = `translateX(-${offset}px)`;

    const dots = dotsContainer.querySelectorAll('.testimonial-dot');
    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === currentIndex);
      dot.setAttribute('aria-selected', i === currentIndex ? 'true' : 'false');
    });

    const totalSlides = Math.ceil(cards.length / cardsPerView);
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= totalSlides - 1;
  }

  function prevSlide() {
    if (currentIndex > 0) { currentIndex--; updateSlider(); }
  }

  function nextSlide() {
    const totalSlides = Math.ceil(cards.length / cardsPerView);
    if (currentIndex < totalSlides - 1) { currentIndex++; updateSlider(); }
  }

  prevBtn.addEventListener('click', prevSlide);
  nextBtn.addEventListener('click', nextSlide);

  let touchStartX = 0;

  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    const diff = touchStartX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 50) {
      diff > 0 ? nextSlide() : prevSlide();
    }
  }, { passive: true });

  slider.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') { prevSlide(); e.preventDefault(); }
    else if (e.key === 'ArrowRight') { nextSlide(); e.preventDefault(); }
  });

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

  createDots();
  updateSlider();

  let autoplayInterval;

  function startAutoplay() {
    autoplayInterval = setInterval(() => {
      const totalSlides = Math.ceil(cards.length / cardsPerView);
      currentIndex = currentIndex >= totalSlides - 1 ? 0 : currentIndex + 1;
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