document.addEventListener('DOMContentLoaded', function () {
  const selectTri = document.querySelector('.filtre-date');
  const grid      = document.querySelector('.grid-photo-home');


  if (!selectTri || !grid) return;

  selectTri.addEventListener('change', function () {
    const order = selectTri.value || 'DESC'; 


    const params = new URLSearchParams();

    params.append('action',  'request_ajax_filtre'); 
    params.append('order',   order);                 
    params.append('page',    1);                     
   

    fetch(NM_AJAX.ajax_url, {

      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: params.toString()
    })
    
    .then(res => res.text())
    .then(html => {
      grid.innerHTML = html; 
    })
    .catch(err => console.error('[AJAX tri] erreur:', err));
  });
});


