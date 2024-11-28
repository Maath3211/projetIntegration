document.addEventListener('DOMContentLoaded', function () {
    // Formatage et validation pour le champ TPS
    document.getElementById('tps').addEventListener('input', function () {
        var input = this.value.replace(/[^0-9]/g, ''); // Supprimer tout sauf les chiffres
        if (input.length > 9) {
            input = input.substring(0, 9); // Limiter à 9 chiffres
        }
        this.value = input; // Mettre à jour la valeur
    });

    // Formatage et validation pour le champ TVQ
    document.getElementById('tvq').addEventListener('input', function () {

        var formatted = '';

        // Ajouter les 10 premiers chiffres
        if (input.length > 0) {
            formatted = input.substring(0, 20); // Jusqu'à 10 chiffres
        }
        
        // // Ajouter " TQ" après les 10 premiers chiffres
        // if (formatted.length === 10) {
        //     formatted += ' TQ';
        // }
        
        // Limiter à 16 caractères
        if (formatted.length > 16) {
            formatted = formatted.substring(0, 16); // Limiter à 16 caractères
        }

        this.value = formatted; // Mettre à jour la valeur
    });
});
