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
        threshold: 0.3, // Ajustez le seuil selon vos besoins
    };
    
    const fuse = new Fuse(data, options);
    let typingTimer; // Timer pour gérer le délai
    
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
        
        // Affichez uniquement les résultats correspondants
        results.forEach(result => {
            result.item.element.style.display = '';
        });
    }
    
    searchInput.addEventListener('input', function() {
        // Annule le timer précédent
        clearTimeout(typingTimer);
        
        // Déclenche la recherche après 3 secondes d'inactivité
        typingTimer = setTimeout(filterItems, 800);
    });
});









document.getElementById('rbq').addEventListener('input', function() {
    var pattern = /^\d{4}-\d{4}-\d{2}$/;
    var input = this.value;
    
    if (!pattern.test(input)) {
        this.setCustomValidity("Le format doit être ####-####-##");
    } else {
        this.setCustomValidity(""); // Réinitialise le message d'erreur si le format est correct
    }
});
