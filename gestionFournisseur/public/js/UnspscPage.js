document.addEventListener('DOMContentLoaded', function() {
    // Récupère l'élément de recherche
    const searchInput = document.getElementById('search-input');
    
    // Récupère tous les éléments à filtrer
    const items = document.querySelectorAll('.item');
    
    // Fonction de filtrage
    function filterItems() {
        const query = searchInput.value.toLowerCase();
        
        items.forEach(item => {
            const code = item.querySelector('.col-md-4 p').textContent.toLowerCase();
            const description = item.querySelector('.col-md-7 p').textContent.toLowerCase();
            
            // Vérifie si la requête est incluse dans le code ou la description
            if (code.includes(query) || description.includes(query)) {
                item.style.display = ''; // Affiche l'élément
            } else {
                item.style.display = 'none'; // Cache l'élément
            }
        });
    }
    
    // Ajoute un écouteur d'événements sur l'input
    searchInput.addEventListener('input', filterItems);
});