document.addEventListener('DOMContentLoaded', function () {
  const $btn  = document.querySelector('.btn-charger-plus');
  const $grid = document.querySelector('.grid-photo-home');

let $currentPage = 1;

  $btn.addEventListener('click', function () {

    

   
    const $parametres = new URLSearchParams();
    $currentPage++;
    $parametres.append('action', 'request_ajax_grid');
    $parametres.append('page',($currentPage)); 

  
   


fetch(NM_AJAX.ajax_url, {
  method: 'POST',
  body: $parametres
})

.then((response) => response.text()) 
.then((html) => {  
  if (html === '') {
   
    $btn.style.display = 'none';
  } else {
    
    $grid.insertAdjacentHTML('beforeend', html);
    initOverlayEvents();
  }
})


.catch((err) => {
  console.error('Erreur AJAX:', err);
});

});
});


