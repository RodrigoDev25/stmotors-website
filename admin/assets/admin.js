(function () {
  'use strict';

  // ================================
  // SIDEBAR MOBILE TOGGLE
  // ================================
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar       = document.getElementById('sidebar');
  const overlay       = document.getElementById('sidebar-overlay');

  function openSidebar() {
    if (!sidebar || !overlay || !sidebarToggle) return;
    sidebar.classList.add('active');
    overlay.classList.add('active');
    sidebarToggle.setAttribute('aria-expanded', 'true');
    sidebarToggle.setAttribute('aria-label', 'Fechar menu lateral');
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar() {
    if (!sidebar || !overlay || !sidebarToggle) return;
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
    sidebarToggle.setAttribute('aria-expanded', 'false');
    sidebarToggle.setAttribute('aria-label', 'Abrir menu lateral');
    document.body.style.overflow = '';
  }

  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.contains('active') ? closeSidebar() : openSidebar();
    });
  }

  if (overlay) {
    overlay.addEventListener('click', closeSidebar);
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && sidebar && sidebar.classList.contains('active')) {
      closeSidebar();
    }
  });

  // ================================
  // TOGGLE VISIBILIDADE SENHA
  // ================================
  const toggleBtn   = document.querySelector('.input-toggle-password');
  const passwordInput = document.getElementById('password');

  if (toggleBtn && passwordInput) {
    toggleBtn.addEventListener('click', () => {
      const isVisible = passwordInput.type === 'text';
      passwordInput.type = isVisible ? 'password' : 'text';
      toggleBtn.setAttribute('aria-label', isVisible ? 'Mostrar senha' : 'Ocultar senha');
    });
  }

})();