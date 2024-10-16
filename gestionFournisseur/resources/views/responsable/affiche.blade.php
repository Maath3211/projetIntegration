@extends('layouts.fournisseur')

@section('title', "Page d'accueil")

<header>
    <div>
        <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
    </div>
    <style>
        .custom-box {
          border: 1px solid #000;
          padding: 10px;
          margin: 10px;
          border-radius: 5px;
        }
        .icon {
          font-size: 1.5em;
          color: green;
        }
        .icon-pdf {
          font-size: 1.2em;
          color: red;
        }
      </style>
</header>

@section('contenu')


  <div class="container">
    <div class="row">
      <!-- Left side sections -->
      <div class="col-md-6">
        <div class="custom-box">
          <h5>État de la demande</h5>
          <p><span class="icon">✔️</span> Acceptée</p>
        </div>

        <div class="custom-box">
          <h5>Identification</h5>
          <p>Wayne Enterprises</p>
          <p>3364717741</p>
          <p>info@wayneenterprises.com</p>
        </div>

        <div class="custom-box">
          <h5>Adresse</h5>
          <p>141, 23e rue<br>Gotham City (Québec) B4T 3A2</p>
          <p>www.wayneenterprises.com</p>
          <p>📞 800-555-8473<br>📠 819-555-3478</p>
        </div>

        <div class="custom-box">
          <h5>Contacts</h5>
          <p>Lucius Fox<br>Directeur général<br><a href="mailto:Lucius.Fox@wayneenterprises.com">Lucius.Fox@wayneenterprises.com</a><br>819-555-5684</p>
          <p>Angela Wells<br>Vice-directrice des finances<br><a href="mailto:AWells@wayneenterprises.com">AWells@wayneenterprises.com</a><br>819-555-3566 #5587</p>
        </div>
      </div>

      <!-- Right side sections -->
      <div class="col-md-6">
        <div class="custom-box">
          <h5>Produits et services offerts</h5>
          <p><strong>Approvisionnements</strong></p>
          <p>G8 - Matériel informatique et logiciel</p>
          <ul>
            <li>43231602 – Progiciel de gestion intégré (pgi)</li>
            <li>32101601 – Mémoire vive (RAM)</li>
            <li>43191501 – Téléphones (téléphone IP)</li>
          </ul>
          <p>G10 – Produits électriques et électroniques</p>
          <ul>
            <li>26111703 – Batterie de véhicule</li>
          </ul>
        </div>

        <div class="custom-box">
          <h5>Détails et spécifications</h5>
          <p>Chef de file en matière de téléphonie IP, nos produits sont garantis et répondent aux normes gouvernementales.</p>
        </div>

        <div class="custom-box">
          <h5>Licence RBQ</h5>
          <p>8227-7542-16 – Entrepreneur <span class="icon">✔️</span> Valide</p>
          <p><strong>Catégories autorisées</strong></p>
          <ul>
            <li>14.1 Routes et canalisation</li>
            <li>15.1 Structures d'ouvrages de génie civil</li>
            <li>13.2 Ouvrages de captage d'eau non forés</li>
            <li>15.7 Travaux de pieux</li>
          </ul>
        </div>

        <div class="custom-box">
          <h5>Finances</h5>
          <p>TPS: 875567987<br>TVC: 764987364816576</p>
          <p><strong>Conditions de paiement</strong><br>Dans les 30 jours suivant la réception</p>
          <p><strong>Conditions de paiement</strong><br>Dans les 30 jours sans déduction</p>
          <p><strong>USD</strong> – Dollars des États-Unis</p>
          <p><strong>Mode de communication</strong><br>Par courriel</p>
        </div>

        <div class="custom-box">
          <h5>Brochures et cartes d'affaire</h5>
          <p><span class="icon-pdf">📄</span> Mon_depliant.pdf – 2177 ko – 07-06-24</p>
          <p><span class="icon-pdf">📄</span> Ma_carte_d_affaire.jpg – 409 ko – 07-06-24</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


@endsection
