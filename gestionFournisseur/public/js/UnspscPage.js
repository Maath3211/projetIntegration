document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const unspscList = document.getElementById('unspsc-list');
    const noResultsMessage = document.getElementById('no-results-message');
    const loadingMessage = document.getElementById('loading-message');

    // Vérification des éléments
    if (!searchInput || !unspscList || !noResultsMessage || !loadingMessage) {
        console.error("Un ou plusieurs éléments nécessaires sont introuvables dans le DOM.");
        return;
    }

    searchInput.addEventListener('input', debounce(function () {
        const query = searchInput.value.trim();

        // Affiche un message de chargement
        loadingMessage.style.display = 'block';
        noResultsMessage.style.display = 'none';

        fetch(`/UNSPSC?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                loadingMessage.style.display = 'none'; // Cache le message de chargement
                if (data.length === 0) {
                    noResultsMessage.style.display = 'block';
                    unspscList.innerHTML = '';
                } else {
                    noResultsMessage.style.display = 'none';
                    updateList(data);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la recherche UNSPSC :', error);
                loadingMessage.style.display = 'none'; // Cache le message de chargement
                noResultsMessage.style.display = 'block';
                noResultsMessage.textContent = "Une erreur s'est produite lors de la recherche.";
            });
    }, 500));

    // Fonction pour mettre à jour dynamiquement la liste
    function updateList(data) {
        unspscList.innerHTML = ''; // Vide la liste avant d'ajouter les nouveaux éléments
        data.forEach(item => {
            const row = document.createElement('div');
            row.classList.add('row', 'item');
            row.innerHTML = `
                <div class="col-md-1">
                    <input type="checkbox" class="mt-2" id="idUnspsc${item.id}" name="idUnspsc[]" value="${item.id}">
                </div>
                <div class="col-md-4">
                    <p>${item.code}</p>
                </div>
                <div class="col-md-7">
                    <p>${item.description}</p>
                </div>
            `;
            unspscList.appendChild(row);
        });
    }

    // Fonction debounce pour limiter les appels réseau
    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }
});