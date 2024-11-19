const btRefuser = document.getElementById("btRefuser");
const btAccepter = document.getElementById("btAccepter");
const form1 = document.getElementById("form1");
const modeleDiv = document.querySelectorAll(".modele");
const lineBreak = document.createElement("br");
var clicked = false;

document.addEventListener("DOMContentLoaded", (event) => {
    modeleDiv.forEach((element) => element.hidden = true);
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
        
        modeleDiv.forEach((element) => element.hidden = false);

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
            modeleDiv.forEach((element) => element.hidden = true);
        });
    }
});
