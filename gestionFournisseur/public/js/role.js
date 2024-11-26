// POPUP DELETE
// *************************************************************
document.getElementById("showPopup").addEventListener("click", function () {
    document.getElementById("popup").style.display = "flex";
    loadPopupContent();
});

document
    .getElementsByClassName("close-button")[0]
    .addEventListener("click", function () {
        document.getElementById("popup").style.display = "none";
    });

window.addEventListener("click", function (event) {
    if (event.target == document.getElementById("popup")) {
        document.getElementById("popup").style.display = "none";
        
    }
});

function loadPopupContent() {
    fetch("/administration/deleteResponsableListe")
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("popupContent").innerHTML = data;
        })
        .catch((error) => {
            console.error("Error loading popup content:", error);
        });
}


// *************************************************************

// Enregistrer role
// *************************************************************
document.addEventListener('DOMContentLoaded', function () {
    // Track changes in each <select> element
    const roleSelects = document.querySelectorAll('.role-select');

    roleSelects.forEach((select) => {
        select.addEventListener('change', () => {
            // Mark the form as "dirty" by setting a data attribute
            const form = select.closest('.roleForm');
            form.setAttribute('data-dirty', 'true');
        });
    });
});

function submitForms() {
    const changedForms = document.querySelectorAll('.roleForm[data-dirty="true"]');
    changedForms.forEach((form, index) => {
        setTimeout(() => {
            form.submit();
        }, index * 100);
    });
}
// *************************************************************
