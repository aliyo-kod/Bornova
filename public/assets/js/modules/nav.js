(function () {
  var header = document.getElementById('site-header');
  var toggle = document.getElementById('nav-toggle');
  var nav = document.getElementById('main-nav');
  var backdrop = document.getElementById('nav-backdrop');

  function setNavOpen(open) {
    toggle.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    nav.classList.toggle('is-open', open);
    backdrop.classList.toggle('is-visible', open);
    document.body.style.overflow = open ? 'hidden' : '';
  }

  if (toggle && nav && backdrop) {
    toggle.addEventListener('click', function () {
      setNavOpen(!nav.classList.contains('is-open'));
    });
    backdrop.addEventListener('click', function () {
      setNavOpen(false);
    });
  }

  // Mobile: tap a dropdown parent link toggles its submenu instead of navigating.
  document.querySelectorAll('.main-nav__item.has-dropdown > .main-nav__link').forEach(function (link) {
    link.addEventListener('click', function (e) {
      if (window.innerWidth > 1023) return;
      e.preventDefault();
      var item = link.closest('.main-nav__item');
      var isOpen = item.classList.contains('is-open');
      document.querySelectorAll('.main-nav__item.has-dropdown.is-open').forEach(function (openItem) {
        if (openItem !== item) openItem.classList.remove('is-open');
      });
      item.classList.toggle('is-open', !isOpen);
    });
  });

  // Desktop: click toggles dropdown (keyboard/touch friendly), outside click closes it.
  document.querySelectorAll('.main-nav__item.has-dropdown').forEach(function (item) {
    var link = item.querySelector('.main-nav__link');
    link.addEventListener('click', function (e) {
      if (window.innerWidth <= 1023) return;
      e.preventDefault();
      var isOpen = item.classList.contains('is-open');
      document.querySelectorAll('.main-nav__item.has-dropdown.is-open').forEach(function (openItem) {
        openItem.classList.remove('is-open');
      });
      item.classList.toggle('is-open', !isOpen);
    });
  });

  document.addEventListener('click', function (e) {
    if (!e.target.closest('.main-nav__item.has-dropdown')) {
      document.querySelectorAll('.main-nav__item.has-dropdown.is-open').forEach(function (item) {
        item.classList.remove('is-open');
      });
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      setNavOpen(false);
      document.querySelectorAll('.main-nav__item.has-dropdown.is-open').forEach(function (item) {
        item.classList.remove('is-open');
      });
    }
  });

  // Sticky header shrink-on-scroll
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }
})();
