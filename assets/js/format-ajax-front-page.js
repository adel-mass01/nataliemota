

    document.addEventListener('DOMContentLoaded', function () {

        new Choices('.filtre-categorie', { searchEnabled: false, shouldSort: false, position: 'bottom' });
        new Choices('.filtre-format', { searchEnabled: false, shouldSort: false, position: 'bottom' });
        new Choices('.filtre-date', { searchEnabled: false, shouldSort: false, position: 'bottom' });




        console.log('dom chargé');

        const selectFormat = document.querySelector('.filtre-format');
        const grid = document.querySelector('.grid-photo-home');

        selectFormat.addEventListener('change', function () {
            const value = selectFormat.value;
            console.log('format sélectionné =', value);

            const params = new URLSearchParams();
            params.append('action', 'request_ajax_format');
            params.append('format', value);
            params.append('page', 1);
            params.append('per_page', 8);

            fetch(NM_AJAX.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            })
                .then(reponse => reponse.text())
                .then(html => {
                    grid.innerHTML = html;
                })
                .catch(err => console.error('Erreur AJAX:', err));
        });
    });


