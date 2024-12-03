const btRefuser = document.getElementById("btRefuser");
const btAccepter = document.getElementById("btAccepter");
const form1 = document.getElementById("form1");
const modele = document.querySelectorAll(".modele");
const refusModeleDiv = document.getElementById('refusModeleDiv');
const lineBreak = document.createElement("br");
var clicked = false;

// ** Afficher et changer modèle de courriel affiché et utilisé **
$(document).ready(function() {
    function chargerContenu() {
        var selectedModelId = $('#templateSelect').val();

        $.ajax({
            url: '/get-template-content',
            method: 'GET',
            data: {
                modelId: selectedModelId
            },
            success: function(response) {
                $('#sujet').text(response.sujet);
                $('#contenu').text(response.contenu);
            },
            error: function(xhr) {
                console.log('Error loading template:', xhr.responseText);
            }
        });
    }

    $('#templateSelect').change(function() {
        chargerContenu();
    });

    chargerContenu();
});
// ****************************************************************************************

// ** Faire afficher les textarea et le css en appuyant sut le bouton refuser **
document.addEventListener("DOMContentLoaded", (event) => {
    modele.forEach((element) => (element.hidden = true));
});

btRefuser.addEventListener("click", function () {
    if (!clicked) {
        btRefuser.style.visibility = "hidden";
        btAccepter.style.visibility = "hidden";

        const raisonRefus = document.createElement("textarea");
        raisonRefus.style.resize = "none";
        raisonRefus.placeholder = "Raison du refus";
        raisonRefus.required = "required";
        raisonRefus.cols = 30;
        raisonRefus.rows = 5;
        raisonRefus.name = "raisonRefus";
        form1.append(raisonRefus);
        raisonRefus.select();

        form1.append(lineBreak);

        refusModeleDiv.style.border = "1px solid #000";
        refusModeleDiv.style.padding = "10px";
        refusModeleDiv.style.margin = "10px";
        refusModeleDiv.style.marginLeft = "0px";
        refusModeleDiv.style.borderRadius = "5px";

        const checkMessageRefus = document.createElement("input");
        checkMessageRefus.type = "checkbox";
        checkMessageRefus.name = "envoyerMessage";
        checkMessageRefus.value = true;
        checkMessageRefus.id = "checkMessageRefus";
        var label = document.createElement("labelCheckMessageRefus");
        label.htmlFor = "checkMessageRefus";
        label.appendChild(
            document.createTextNode("Envoyer la raison du refus")
        );
        form1.append(checkMessageRefus);
        form1.append(label);

        form1.append(lineBreak);

        const btConfirmer = document.createElement("button");
        btConfirmer.textContent = "Confirmer";
        btConfirmer.className = "btn btn-danger";
        btConfirmer.type = "submit";
        form1.append(btConfirmer);

        const btAnnuler = document.createElement("a");
        btAnnuler.textContent = "Annuler";
        btAnnuler.className = "btn btn-secondary";
        form1.append(btAnnuler);

        
        modele.forEach((element) => (element.hidden = false));

        btAnnuler.addEventListener("click", function () {
            btRefuser.style.visibility = "visible";
            btAccepter.style.visibility = "visible";
            raisonRefus.remove();
            btConfirmer.remove();
            clicked = false;
            btAnnuler.remove();
            checkMessageRefus.remove();
            label.remove();
            lineBreak.remove();
            modele.forEach((element) => (element.hidden = true));
            refusModeleDiv.style.border = "0px solid #000";
            refusModeleDiv.style.padding = "0px";
            refusModeleDiv.style.margin = "0px";
            refusModeleDiv.style.marginLeft = "0px";
            refusModeleDiv.style.borderRadius = "px";
        });
    }
});
// ****************************************************************************************