// document.addEventListener('DOMContentLoaded', function() {
//     // Récupère l'élément de recherche
//     const searchInput = document.getElementById('search-input');
    
//     // Récupère tous les éléments à filtrer
//     const items = document.querySelectorAll('.item');
    
//     // Fonction de filtrage
//     function filterItems() {
//         const query = searchInput.value.toLowerCase();
        
//         items.forEach(item => {
//             const code = item.querySelector('.col-md-4 p').textContent.toLowerCase();
//             const description = item.querySelector('.col-md-7 p').textContent.toLowerCase();
            
//             // Vérifie si la requête est incluse dans le code ou la description
//             if (code.includes(query) || description.includes(query)) {
//                 item.style.display = ''; // Affiche l'élément
//             } else {
//                 item.style.display = 'none'; // Cache l'élément
//             }
//         });
//     }
    
//     // Ajoute un écouteur d'événements sur l'input
//     searchInput.addEventListener('input', filterItems);
// });

// TODO: améliorer le triage des élément EX: si je tape 111 y vas chercher dans l'ordre de ma liste si ya 3-1 qui suit Pas claire mais je comprends
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const items = Array.from(document.querySelectorAll('.item'));

    // Préparer les données pour Fuse.js
    let data = items.map(item => ({
        element: item,
        code: item.querySelector('.col-md-4 p').textContent.toLowerCase(),
        description: item.querySelector('.col-md-7 p').textContent.toLowerCase(),
    }));

    const options = {
        keys: ['code', 'description'],
        threshold: 0.2, // Ajuster selon les besoins (0.0 = correspondance exacte, 1.0 = correspondance plus large)
    };

    const fuse = new Fuse(data, options);

    function filterItems() {
        const query = searchInput.value.toLowerCase();

        if (query.trim() === '') {
            // Affiche tous les éléments si la requête est vide
            items.forEach(item => item.style.display = '');
            return;
        }

        const results = fuse.search(query);

        // Trier les résultats pour afficher d'abord les codes commençant par la chaîne, puis ceux qui la contiennent au milieu
        const sortedResults = results.sort((a, b) => {
            const aCode = a.item.code;
            const bCode = b.item.code;

            // Prioriser les codes commençant par la chaîne recherchée
            const startsWithA = aCode.startsWith(query);
            const startsWithB = bCode.startsWith(query);

            if (startsWithA && !startsWithB) return -1;
            if (!startsWithA && startsWithB) return 1;

            // Si ni l'un ni l'autre ne commence par la chaîne, on continue avec la position de la chaîne dans le code
            const indexA = aCode.indexOf(query);
            const indexB = bCode.indexOf(query);

            return indexA - indexB; // Plus c'est proche du début, plus c'est prioritaire
        });

        // Masque tous les éléments
        items.forEach(item => item.style.display = 'none');

        // Affiche les résultats triés
        sortedResults.forEach(result => {
            result.item.element.style.display = '';
        });
    }

    searchInput.addEventListener('input', filterItems);
});



let page = 1; // Page actuelle

// Fonction pour charger plus de données
function loadMoreItems() {
    page++; // Passe à la page suivante

    fetch(`/loadMoreUnspsc?page=${page}`)
        .then(response => response.json())
        .then(data => {
            data.codes.forEach(code => {
                // Créer dynamiquement un nouvel élément dans le DOM
                let itemHtml = `
                    <div class="item">
                        <div class="col-md-1">
                            <input type="radio" name="idUnspsc" value="${code.id}">
                        </div>
                        <div class="col-md-4">
                            <p>${code.code}</p>
                        </div>
                        <div class="col-md-7">
                            <p>${code.description}</p>
                        </div>
                    </div>
                `;
                document.querySelector('.scroll-container').insertAdjacentHTML('beforeend', itemHtml);
            });

            // Mettre à jour les données pour Fuse.js avec les nouveaux éléments
            updateFuseData();
        });
}

// Détection de l'arrivée en bas de la page
window.addEventListener('scroll', function() {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        loadMoreItems(); // Charger plus d'éléments quand on atteint le bas de la page
    }
});

// Mettre à jour Fuse.js avec les nouveaux éléments
function updateFuseData() {
    const items = Array.from(document.querySelectorAll('.item'));
    data = items.map(item => ({
        element: item,
        code: item.querySelector('.col-md-4 p').textContent.toLowerCase(),
        description: item.querySelector('.col-md-7 p').textContent.toLowerCase(),
    }));
    fuse.setCollection(data); // Mettre à jour la collection dans Fuse.js
}








document.getElementById('rbq').addEventListener('input', function() {
    var pattern = /^\d{4}-\d{4}-\d{2}$/;
    var input = this.value;
    
    if (!pattern.test(input)) {
        this.setCustomValidity("Le format doit être ####-####-##");
    } else {
        this.setCustomValidity(""); // Réinitialise le message d'erreur si le format est correct
    }
});