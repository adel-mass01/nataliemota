document.addEventListener('DOMContentLoaded', function () {
  const overlay      = document.querySelector('.lightbox');
  const btn_x        = document.querySelector('.lightbox__close');
  const img          = document.querySelector('.lightbox__container img');
  const btn_suivant  = document.querySelector('.lightbox__next');
  const btn_precedent= document.querySelector('.lightbox__prev');

  let current = 0;

 
  window.initOverlayEvents = function () {

    // CLICK SUR L'ŒIL
    
    const oeils = document.querySelectorAll('.icon_eye_container');
    oeils.forEach(oeil => {
      oeil.addEventListener('click', () => {
        console.log('jai cliqué');
        const url = oeil.getAttribute('data-url');
        if (url) {
          window.location.href = url;
        }
      });
    });

    // CLICK SUR ICON FULL SCREEN
    const fullscreen = document.querySelectorAll('.icon_fullscreen_container');
    fullscreen.forEach((icon, index) => {
      icon.addEventListener('click', function () {
        current = index;
        const url = icon.dataset.full;
        img.src = url;
        overlay.classList.add('is-open');
      });
    });
  }

  
  initOverlayEvents();

  // CLIQUE SUR LA CROIX DE LA LIGHTBOX
  btn_x.addEventListener('click', function() {
    overlay.classList.remove('is-open');
  });

  // CLIQUE SUR SUIVANT
  btn_suivant.addEventListener('click', function() {
    const fullscreen = document.querySelectorAll('.icon_fullscreen_container');
    current = (current + 1) % fullscreen.length;
    img.src = fullscreen[current].dataset.full;
  });

  // CLIQUE SUR PRECEDENT
  btn_precedent.addEventListener('click', function() {
    const fullscreen = document.querySelectorAll('.icon_fullscreen_container');
    current = (current - 1 + fullscreen.length) % fullscreen.length;
    img.src = fullscreen[current].dataset.full;
  });


});



