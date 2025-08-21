document.addEventListener('DOMContentLoaded', function() {
  const modal   = document.getElementById('contactModal');
  const overlay = document.getElementById('modalOverlay');
  const refInput = modal.querySelector('.recup-ref-photo');

  // Ouvrir la modale depuis TOUS les déclencheurs
  document.querySelectorAll('.open-modal-button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      // si le bouton porte une ref, on la met dans le champ
      if (this.dataset.ref && refInput) {
        refInput.value = this.dataset.ref;
      }

      modal.classList.add('active');
    });
  });

  // Fermer la modale en cliquant sur l’overlay
  overlay.addEventListener('click', function() {
    modal.classList.remove('active');
  });
});


document.addEventListener('DOMContentLoaded', function() {
  const btn_hamburger = document.getElementById('hamburger');
  const overlay = document.getElementById('mobile-overlay');

  // Ouvrir le menu mobile
  btn_hamburger.addEventListener('click', function() {
    overlay.classList.toggle('is-active');
    btn_hamburger.classList.toggle('is-open');
  });
});

