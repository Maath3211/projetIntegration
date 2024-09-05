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
    
    // Préparez les données pour Fuse.js
    const data = items.map(item => ({
        element: item,
        code: item.querySelector('.col-md-4 p').textContent.toLowerCase(),
        description: item.querySelector('.col-md-7 p').textContent.toLowerCase(),
    }));
    
    const options = {
        keys: ['code', 'description'],
        threshold: 0.1, // Ajustez le seuil selon vos besoins
    };
    
    const fuse = new Fuse(data, options);
    
    function filterItems() {
        const query = searchInput.value.toLowerCase();
        
        if (query.trim() === '') {
            // Affichez tous les éléments si la requête est vide
            items.forEach(item => item.style.display = '');
            return;
        }
        
        const results = fuse.search(query);
        
        // Masquez tous les éléments d'abord
        items.forEach(item => item.style.display = 'none');
        
        results.forEach(result => {
            result.item.element.style.display = '';
        });
    }
    
    searchInput.addEventListener('input', filterItems);
});