const btRefuser = document.getElementById("btRefuser");
const btAccepter = document.getElementById("btAccepter");
const form1 = document.getElementById("form1");
var clicked = false;

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

        const btConfirmer = document.createElement("button");
        btConfirmer.textContent = "Confirmer";
        btConfirmer.className = "btn btn-danger";
        btConfirmer.type = "submit";
        form1.append(btConfirmer);

        const btAnnuler = document.createElement("a");
        btAnnuler.textContent = "Annuler";
        btAnnuler.className = "btn btn-secondary";
        form1.append(btAnnuler);

        btAnnuler.addEventListener("click", function () {
            btRefuser.style.visibility = "visible";
            btAccepter.style.visibility = "visible";
            raisonRefus.remove();
            btConfirmer.remove();
            clicked = false;
            btAnnuler.remove();
        });
    }
});
