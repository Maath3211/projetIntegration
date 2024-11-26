document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchMessage = document.getElementById('no-results-message');
    const unspscItems = document.getElementById('unspsc-items');
    const items = Array.from(document.querySelectorAll('.item'));

    // Préparez les données pour Fuse.js
    const data = items.map(item => ({
        element: item,
        code: item.querySelector('.col-md-4 p').textContent.toLowerCase(),
        description: item.querySelector('.col-md-7 p').textContent.toLowerCase(),
    }));
    
    const options = {
        keys: ['code', 'description'],
        threshold: 0.3,
    };
    
    const fuse = new Fuse(data, options);
    let typingTimer;
    function filterItems() {
        const query = searchInput.value.toLowerCase().trim();
        if (query === '') {
            // Si la requête est vide, affiche le message de recherche et masque les items
            searchMessage.style.display = 'block';
            unspscItems.style.display = 'none';
            return;
        }
        // Sinon, cache le message et affiche le conteneur des items
        searchMessage.style.display = 'none';
        unspscItems.style.display = 'block';

        // Effectue la recherche
        const results = fuse.search(query);

        // Masque tous les éléments d'abord
        items.forEach(item => item.style.display = 'none');

        // Affiche uniquement les résultats correspondants
        if (results.length > 0) {
            results.forEach(result => {
                result.item.element.style.display = '';
            });
        } else {
            // Affiche un message si aucun résultat n'est trouvé
            searchMessage.textContent = 'Aucun résultat trouvé';
            searchMessage.style.display = 'block';
        }
    }

    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(filterItems, 800);
    });
});