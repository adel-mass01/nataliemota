  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('contactModal');
    const overlay = document.getElementById('modalOverlay');

    // Ouvrir la modale
    document.querySelector('.open-modal-button').addEventListener('click', function() {
      modal.classList.add('active');
    });

    // Fermer la modale en cliquant sur l'overlay
    overlay.addEventListener('click', function() {
      modal.classList.remove('active');
    });
  });