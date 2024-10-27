function updateDisplay() {
    const showPending = document.querySelector('#pending').checked;
    const showAccepted = document.querySelector('#accepted').checked;
    const showRefused = document.querySelector('#refused').checked;
  
    document.querySelectorAll('.fournisseur-row').forEach(row => {
      const statut = row.dataset.statut;
  
      if ((statut === 'En attente' && showPending) ||
          (statut === 'Acceptée' && showAccepted) ||
          (statut === 'Refusées' && showRefused)) {
        row.style.display = ''; 
      } else {
        row.style.display = 'none'; 
      }
    });
  }
  
  // Écoute les changements de chaque case à cocher
  document.querySelector('#pending').addEventListener('change', updateDisplay);
  document.querySelector('#accepted').addEventListener('change', updateDisplay);
  document.querySelector('#refused').addEventListener('change', updateDisplay);
  
  // Mise à jour initiale de l'affichage
  updateDisplay();

