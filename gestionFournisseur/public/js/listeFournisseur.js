// Get references to the table and search controls
const table = document.querySelector('table');
const searchInput = document.querySelector('.search-input');
const searchButton = document.querySelector('.search-button');

// Function to filter the table rows based on search input
function filterTable() {
  const searchTerm = searchInput.value.toLowerCase();

  // Hide/show rows based on search term
  document.querySelectorAll('.fournisseur-row').forEach(row => {
    const cells = row.querySelectorAll('td');
    let matchFound = false;

    // Check if any cell content matches the search term
    for (let i = 0; i < cells.length; i++) {
      if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
        matchFound = true;
        break;
      }
    }

    // Show the row if a match is found, hide it otherwise
    row.style.display = matchFound ? '' : 'none';
  });
}

// Add event listeners to the search controls
searchInput.addEventListener('input', filterTable);
searchButton.addEventListener('click', filterTable);

// Update the display based on the checkboxes (existing code)
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

// Attach event listeners to the checkboxes (existing code)
document.querySelector('#pending').addEventListener('change', updateDisplay);
document.querySelector('#accepted').addEventListener('change', updateDisplay);
document.querySelector('#refused').addEventListener('change', updateDisplay);

// Initial update of the display (existing code)
updateDisplay();