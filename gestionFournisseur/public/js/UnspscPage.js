document.addEventListener('DOMContentLoaded', function () {
    // Vérifie si on est sur la page UNSPSC ou sur la page de modification UNSPSC
    const isUnspscPage = document.getElementById('unspsc-page') !== null;
    const isEditUnspscPage = document.getElementById('edit-unspsc-page') !== null;

    const unspscDataElement = document.getElementById('unspsc-data');
    let selectedUnspscIds = JSON.parse(unspscDataElement.getAttribute('data-unspsc'));

    console.log(selectedUnspscIds);

    const loadingMessage = document.getElementById('loading-message');
    if (loadingMessage) {
        console.log("élément loading-message trouvé.");
    } else {
        console.log("élément loading-message introuvable.");
    }

    if (isUnspscPage) {
        // Code spécifique pour la page UNSPSC
        initializeUnspscPage();
    }

    if (isEditUnspscPage) {
        // Code spécifique pour la page de modification UNSPSC
        initializeEditUnspscPage();
    }

    // Fonctions réutilisables
    function initializeUnspscPage() {
        console.log('Page UNSPSC');
        setupSearchFunctionality('/UNSPSC'); // URL pour la recherche
    }

    function initializeEditUnspscPage() {
        console.log('Page Edit UNSPSC');
        var test = document.getElementById('test');
        var testText = test.textContent.trim(); 
        setupSearchFunctionality('/UNSPSC/' + testText + '/modifier'); // URL pour la recherche sur la page de modification
    }

    function getSelectedIds() {
        const selectedIds = [];
        document.querySelectorAll('input[name="idUnspsc[]"]:checked').forEach(checkbox => {
            console.log('Case sélectionnée :', checkbox.value);
            selectedIds.push(checkbox.value);
        });
        console.log("selectedIds:", selectedIds);
        return selectedIds;
    }

    function setupSearchFunctionality(apiUrl) {
        const searchInput = document.getElementById('search-input');
        const unspscList = document.getElementById('unspsc-list');
        const noResultsMessage = document.getElementById('no-results-message');

        searchInput.addEventListener('input', debounce(function () {
            const query = searchInput.value.trim();

            // Affiche un message de chargement
            document.getElementById('loading-message').style.display = 'block';

            fetch(`${apiUrl}?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loading-message').style.display = 'none';
                    if (data.length === 0) {
                        noResultsMessage.style.display = 'block';
                        unspscList.innerHTML = '';
                    } else {
                        noResultsMessage.style.display = 'none';
                        updateList(data);
                    }
                })
                .catch(error => console.error('Erreur lors de la recherche UNSPSC :', error));
        }, 500));

        function updateList(data) {
            unspscList.innerHTML = ''; // Vide la liste avant de la remplir à nouveau
            
            // Filtrer les éléments sélectionnés et non sélectionnés
            const selectedItems = data.filter(item => selectedUnspscIds.includes(item.id));
            const filteredItems = data.filter(item => !selectedUnspscIds.includes(item.id));
        
            // Afficher les éléments déjà sélectionnés en premier (cochés)
            selectedItems.forEach(item => {
                const row = document.createElement('div');
                row.classList.add('row', 'item');
                row.innerHTML = `
                    <div class="col-md-1">
                        <input type="checkbox" class="mt-2" id="idUnspsc${item.id}" name="idUnspsc[]" value="${item.id}" checked>
                    </div>
                    <div class="col-md-4">
                        <p>${item.code}</p>
                    </div>
                    <div class="col-md-7">
                        <p>${item.description}</p>
                    </div>
                `;
                unspscList.appendChild(row);
        
                // Ajoute un événement de changement (coché/décoché) pour mettre à jour selectedUnspscIds
                const checkbox = row.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', function () {
                    if (checkbox.checked) {
                        // Si la case est cochée, ajoute l'ID à selectedUnspscIds
                        if (!selectedUnspscIds.includes(item.id)) {
                            selectedUnspscIds.push(item.id);
                        }
                    } else {
                        // Si la case est décochée, retire l'ID de selectedUnspscIds
                        selectedUnspscIds = selectedUnspscIds.filter(id => id !== item.id);
                    }
                    console.log("Updated selectedUnspscIds: ", selectedUnspscIds);
                });
            });
        
            // Afficher les éléments non sélectionnés ensuite
            filteredItems.forEach(item => {
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
        
                // Ajoute un événement de changement (coché/décoché) pour mettre à jour selectedUnspscIds
                const checkbox = row.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', function () {
                    if (checkbox.checked) {
                        // Si la case est cochée, ajoute l'ID à selectedUnspscIds
                        if (!selectedUnspscIds.includes(item.id)) {
                            selectedUnspscIds.push(item.id);
                        }
                    } else {
                        // Si la case est décochée, retire l'ID de selectedUnspscIds
                        selectedUnspscIds = selectedUnspscIds.filter(id => id !== item.id);
                    }
                    console.log("Updated selectedUnspscIds: ", selectedUnspscIds);
                });
            });
        }
        
        
        
        
        
        
        
        
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
