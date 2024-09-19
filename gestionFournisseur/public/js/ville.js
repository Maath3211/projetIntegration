document.addEventListener('DOMContentLoaded', function() {
    const provinceChoisie = document.getElementById('province');
    const ville = document.getElementById('ville');
    const villeInput = document.getElementById('villeInput');

    function affichageVille() {
        if (provinceChoisie.value === 'Québec') {
            ville.style.display = 'block';
            villeInput.style.display = 'none';
            ville.disabled = false;
            villeInput.disabled = true;
        } else {
            ville.style.display = 'none';
            villeInput.style.display = 'block';
            ville.disabled = true;
            villeInput.disabled = false;
        }
    }
    
    provinceChoisie.addEventListener('change', affichageVille);
    affichageVille();
});
