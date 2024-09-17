/* document.addEventListener("DOMContentLoaded", function () {
    ajoutForm2();ajoutForm3(); 
}); */

const form1Div = document.getElementById("form1Div");
const plus1 = document.getElementById("plus1");
var i = 0;

plus1.addEventListener("click", function () {
    if (i === 0) ajoutForm2();
    else if (i === 1) {
        plus1.remove();
        ajoutForm3();
    }
});

function submitForms() {
    switch (i) {
        case 0:
            document.getElementById("form1").submit();
            break;
        case 1:
            document.getElementById("form1").submit();
            setTimeout(() => document.getElementById("form2").submit(), 100);
            break;
        case 2:
            document.getElementById("form1").submit();
            setTimeout(() => {
                document.getElementById("form2").submit();
                setTimeout(() => document.getElementById("form3").submit(), 100);
            }, 100);
            break;
    }
}

function ajoutForm2() {
    form1Div.classList.remove("col-md-6", "offset-3");
    form1Div.classList.add("col-md-3", "offset-2");

    const form2Div = form1Div.cloneNode(true);
    form2Div.id = "form2Div";

    const form2 = form2Div.querySelector("#form1");
    const form2Titre = form2Div.querySelector("#numContact1");
    const form2Prenom = form2Div.querySelector("#prenom1");
    const form2Nom = form2Div.querySelector("#nom1");
    const form2Fonction = form2Div.querySelector("#fonction1");
    const form2Courriel = form2Div.querySelector("#courriel1");
    const form2TypeTelephone = form2Div.querySelector("#typeTelephone1");
    const form2Telephone = form2Div.querySelector("#telephone1");
    const form2Poste = form2Div.querySelector("#poste1");

    form2.id = "form2";

    form2Titre.id = "Contact2";
    form2Titre.innerHTML = "Contact 2";

    form2Prenom.id = "prenom2";

    form2Nom.id = "nom2";

    form2Fonction.id = "fonction2";

    form2Courriel.id = "courriel2";

    form2TypeTelephone.id = "typeTelephone2";

    form2Telephone.id = "telephone2";

    form2Poste.id = "poste2";

    form1Div.insertAdjacentElement("afterend", form2Div);
    i++;
}

function ajoutForm3() {
    form1Div.classList.remove("col-md-3", "offset-2");
    form1Div.classList.add("col-md-2", "offset-2");
    form2Div.classList.remove("col-md-3", "offset-2");
    form2Div.classList.add("col-md-2", "offset-1");

    const form3Div = form1Div.cloneNode(true);
    form3Div.classList.remove("col-md-3", "offset-2");
    form3Div.classList.add("col-md-2", "offset-1");
    form3Div.id = "form3Div";

    const form3 = form3Div.querySelector("#form1");
    const form3Titre = form3Div.querySelector("#numContact1");
    const form3Prenom = form3Div.querySelector("#prenom1");
    const form3Nom = form3Div.querySelector("#nom1");
    const form3Fonction = form3Div.querySelector("#fonction1");
    const form3Courriel = form3Div.querySelector("#courriel1");
    const form3TypeTelephone = form3Div.querySelector("#typeTelephone1");
    const form3Telephone = form3Div.querySelector("#telephone1");
    const form3Poste = form3Div.querySelector("#poste1");

    form3.id = "form3";

    form3Titre.id = "Contact3";

    form3Prenom.id = "prenom3";

    form3Nom.id = "nom3";

    form3Fonction.id = "fonction3";

    form3Courriel.id = "courriel3";

    form3TypeTelephone.id = "typeTelephone3";

    form3Telephone.id = "telephone3";

    form3Poste.id = "poste3";

    form2Div.insertAdjacentElement("afterend", form3Div);

    i++;
}
