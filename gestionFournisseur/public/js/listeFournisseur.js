

//Code qui regarde si un fournisseur est sélectionner
document.getElementById('showSelectedBtn').addEventListener('click', function () {
  const selectedFournisseurs = Array.from(document.querySelectorAll('.select-fournisseur:checked'))
      .map(checkbox => checkbox.value);

  if (selectedFournisseurs.length > 0) {
      const url = `/responsable/fournisseurs/details?ids=${selectedFournisseurs.join(',')}`;
      window.location.href = url;
  } else {
      alert('Veuillez sélectionner au moins un fournisseur.');
  }
});

// Get references to the table and filter controls
const table = document.querySelector('table');
const searchInput = document.querySelector('.search-input');
const searchButton = document.querySelector('.search-button');
const unspscSelect = document.querySelector('#unspsc');
const rbqSelect = document.querySelector('#rbq');
const citySelect = document.querySelector('#villes');

// Function to filter table rows based on all active filters
function filterTable() {
  // First filter by status
  const showPending = document.querySelector('#pending').checked;
  const showAccepted = document.querySelector('#accepted').checked;
  const showRefused = document.querySelector('#refused').checked;
  const showToReview = document.querySelector('#to-review').checked;

  const rowsToDisplay = [];

  // Filter based on status
  document.querySelectorAll('.fournisseur-row').forEach(row => {
    const statut = row.dataset.statut;
    const shouldDisplay =
      (statut === 'En attente' && showPending) ||
      (statut === 'Acceptées' && showAccepted) ||
      (statut === 'Refusées' && showRefused) ||
      (statut === 'À réviser' && showToReview);

    // Store rows that match the status filter
    if (shouldDisplay) {
      rowsToDisplay.push(row);
    } else {
      row.style.display = 'none'; // Hide rows that don't match status
    }
  });

  // Get search term and selected options
  const searchTerm = searchInput.value.toLowerCase();
  const selectedUnspsc = Array.from(unspscSelect.selectedOptions).map(option => option.value);
  const selectedRbq = Array.from(rbqSelect.selectedOptions).map(option => option.value);
  const selectedCity = citySelect.value;

  // Now filter the visible rows based on other filters
  rowsToDisplay.forEach(row => {
    const cells = row.querySelectorAll('td');
    const cityCell = cells[4].textContent.trim(); // Column index for city cell
    const unspscCell = cells[6].textContent.toLowerCase(); // Column index for UNSPSC cell
    const rbqCell = cells[5].textContent.toLowerCase(); // Column index for RBQ cell

    // Check if row matches search term
    const searchMatch = searchTerm === "" || Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));

    // Check if row matches UNSPSC selection (skip filter if "Aucun" selected)
    const unspscMatch = selectedUnspsc.includes("") || selectedUnspsc.some(unspsc => unspscCell.includes(unspsc.toLowerCase()));

    // Check if row matches RBQ selection (skip filter if "Aucun" selected)
    const rbqMatch = selectedRbq.includes("") || selectedRbq.some(rbq => rbqCell.includes(rbq.toLowerCase()));

    // Check if row matches city selection (skip filter if "Aucun" selected)
    const cityMatch = selectedCity === "" || cityCell === selectedCity;

    // Show row if all conditions are met
    row.style.display = (searchMatch && unspscMatch && rbqMatch && cityMatch) ? '' : 'none';
  });
}

// Attach event listeners to the search controls
searchInput.addEventListener('input', filterTable);
searchButton.addEventListener('click', filterTable);

// Attach event listeners to the filter dropdowns
unspscSelect.addEventListener('change', filterTable);
rbqSelect.addEventListener('change', filterTable);
citySelect.addEventListener('change', filterTable);

// Attach event listeners to the status checkboxes
document.querySelector('#pending').addEventListener('change', filterTable);
document.querySelector('#accepted').addEventListener('change', filterTable);
document.querySelector('#refused').addEventListener('change', filterTable);
document.querySelector('#to-review').addEventListener('change', filterTable);

// Initial display setup
filterTable();


