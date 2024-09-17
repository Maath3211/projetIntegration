var isBackspaceOrDelete = false; // Pour détecter si Backspace ou Delete est pressé

document.getElementById('search-input').addEventListener('keydown', function(e) {
    // Vérifier si la touche pressée est Backspace ou Delete
    if (e.key === 'Backspace' || e.key === 'Delete') {
        isBackspaceOrDelete = true;
    } else {
        isBackspaceOrDelete = false;
    }
});

document.getElementById('search-input').addEventListener('input', function(e) {
    var input = this.value.replace(/[^a-zA-Z0-9]/g, ''); // Supprimer tout caractère non alphanumérique
    
    // Permettre la suppression sans ajouter automatiquement les tirets
    if (!isBackspaceOrDelete) {
        // Ajouter les tirets après chaque groupe de caractères
        if (input.length > 4) {
            input = input.substring(0, 4) + '-' + input.substring(4);
        }
        if (input.length > 9) {
            input = input.substring(0, 9) + '-' + input.substring(9, 11);
        }
    }

    this.value = input; // Mettre à jour la valeur de l'input
});