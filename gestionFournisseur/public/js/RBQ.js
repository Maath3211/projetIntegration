document.getElementById('search-input').addEventListener('input', function(e) {
    // Supprimer tout caractère non alphanumérique
    var input = this.value.replace(/[^a-zA-Z0-9]/g, '');
    
    // Ajouter les tirets après chaque groupe de caractères
    if (input.length > 4) {
        input = input.substring(0, 4) + '-' + input.substring(4);
    }
    if (input.length > 10) {
        input = input.substring(0, 10) + '-' + input.substring(9, 11);
    }

    this.value = input; // Mettre à jour la valeur de l'input
});

// Empêche l'insertion d'autres caractères que lettres et chiffres
document.getElementById('search-input').addEventListener('keydown', function(e) {
    var key = e.key;
    if (!/[a-zA-Z0-9]/.test(key) && key !== 'Backspace' && key !== 'Tab' && key !== 'ArrowLeft' && key !== 'ArrowRight') {
        e.preventDefault();
    }
});