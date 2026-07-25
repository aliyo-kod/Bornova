(function () {
  var modal = document.getElementById('video-modal');
  var modalBody = document.getElementById('video-modal-body');
  var modalTitle = document.getElementById('video-modal-title');
  var lastFocused = null;

  function openModal(videoSrc, title) {
    if (!modal || !modalBody) return;
    lastFocused = document.activeElement;
    modalBody.innerHTML = '<video src="' + videoSrc + '" controls autoplay playsinline></video>';
    if (modalTitle) modalTitle.textContent = title || 'Video oynatıcı';
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    var closeBtn = modal.querySelector('.modal__close');
    if (closeBtn) closeBtn.focus();
  }

  function closeModal() {
    if (!modal || !modalBody) return;
    modalBody.innerHTML = '';
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
  }

  document.querySelectorAll('.video-card').forEach(function (card) {
    var btn = card.querySelector('.video-card__btn');
    var src = card.getAttribute('data-video-src');
    var title = card.getAttribute('data-video-title');
    if (!btn || !src) return;
    btn.addEventListener('click', function () {
      openModal(src, title);
    });
  });

  if (modal) {
    modal.querySelectorAll('[data-modal-close]').forEach(function (el) {
      el.addEventListener('click', closeModal);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
    });
  }
})();
