
document.getElementById('search-input').addEventListener('input', function (e) {
    var input = this.value.replace(/[^0-9]/g, ''); // Supprimer tout sauf les chiffres
    var formatted = '';


    // Ajouter les tirets après chaque groupe de caractères
    if (input.length > 0) {
        formatted = input.substring(0, 4);
    }
    if (input.length > 4) {
        formatted += '-' + input.substring(4, 8);
    }
    if (input.length > 8) {
        formatted += '-' + input.substring(8, 10);
    }

    this.value = formatted; // Mettre à jour la valeur du champ
});
