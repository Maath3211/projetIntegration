document.querySelector('#accepted').addEventListener('change', function() {
    const isChecked = this.checked;
    document.querySelectorAll('.fournisseur-row').forEach(row => {
        // Affiche uniquement les lignes avec statut "accepté" si la case est cochée
        if (isChecked && row.dataset.statut === 'Acceptée') {
            row.style.display = '';
        } else if (!isChecked && row.dataset.statut === 'Acceptée') {
            row.style.display = 'none';
        } else if (row.dataset.statut !== 'Acceptée') {
            row.style.display = '';  // Réaffiche les autres statuts
        }
    });
});