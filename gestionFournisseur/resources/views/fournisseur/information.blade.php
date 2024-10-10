@extends('layouts.fournisseur')
@section('title',"Informations")
<header>
    <link rel="stylesheet" href="{{ asset('css/information.css') }}">
    <div>
        <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
    </div>
    <nav class="sub-nav">
        <form action="{{ route('fournisseur.logout') }}" method="post">
        @csrf
        <button id="bouton1" type="submit">Déconnecter</button>
        </form>
    </nav> 
    

</header>
@section('contenu')



  <div class="container">
    <div class="row">
      <!-- Left side sections -->
      <div class="col-md-6">
        <div class="custom-box">
          <h5>État de la demande</h5>
          <p><span class="icon">✔️</span> {{$fournisseur->statut}}</p>
        </div>

        <div class="custom-box">
          <h5>Identification</h5>
          <p>{{$fournisseur->entreprise}}</p>
          <p>{{$fournisseur->neq}}</p>
          <p>{{$fournisseur->email}}</p>
        </div>

        <div class="custom-box">
          <h5>Adresse</h5>
          <p>{{$coordonee->noCivic}}, rue {{$coordonee->rue}}<br>{{$coordonee->ville}} ({{$coordonee->province}}) {{$coordonee->codePostal}}</p>
          <p>site: {{$coordonee->site}}</p>
          <p>📞 {{$coordonee->typeTel}}: {{$coordonee->numero}}</p>
        </div>

        <div class="custom-box">
          <h5>Contacts</h5>
          <p>{{$contact->prenom}} {{$contact->nom}}<br>{{$contact->fonction}}<br>{{$contact->courriel}}<br>{{$contact->telephone}}</p>
          
        </div>
      </div>

      <!-- Right side sections -->
      <div class="col-md-6">
        <div class="custom-box">
          <h5>Produits et services offerts</h5>
          <p><strong>Approvisionnements</strong></p>
          <p>{{$unspscCode->categorie}}</p>
          <ul>
            <li>{{$unspscCode->description}}</li>
          </ul>

        </div>

        <div class="custom-box">
          <h5>Détails et spécifications</h5>
          <p>{{$unspsc->details}}</p>
        </div>

        <div class="custom-box">
          <h5>Licence RBQ</h5>
          <p>{{$rbq->licenceRBQ}} – {{$rbq->typeLicence}} <span class="icon">✔️</span> {{$rbq->statut}}</p>
          <p><strong>Catégories autorisées</strong></p>
          <ul>
            <li>{{$categorie->codeSousCategorie}} {{$categorie->nom}}</li>
          </ul>
        </div>

        <div class="custom-box">
          <h5>Finances</h5>
          <p>TPS: {{$finance->tps}}<br>TVC: {{$finance->tvq}}</p>
          <p><strong>Conditions de paiement</strong><br>{{$finance->paiement}}</p>
          <p><strong>Devise</strong> – {{$finance->devise}}</p>
          <p><strong>Mode de communication</strong><br>{{$finance->communication}}</p>
        </div>

        <div class="custom-box">
          <h5>Document</h5>
          <p><span class="icon-pdf">📄</span> {{$file->nomFichier}} – {{$file->tailleFichier_KO}} – {{$file->created_at}}</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>




{{-- 
@if (isset($fournisseur))
    <div class="container-fluid text-center ">
        <h1 class="titreForm"> Page d'informations de NEQ : {{$fournisseur->neq}} <br> EMAIL : {{$fournisseur->email}} <br>ENTREPRISE : {{$fournisseur->entreprise}} STATUT: {{$fournisseur->statut}}</h1>
        <h1 class="titreForm"> LICENCERBQ: {{$rbq->licenceRBQ}} STATUT: {{$rbq->statut}} <br> TYPELICENCE: {{$rbq->typeLicence}} </h1>
        <h1 class="titreForm"> Code Sous categorie: {{$categorie->codeSousCategorie}} <br> nom categorie: {{$categorie->nom}} <br> type categorie: {{$categorie->nomCategorie}} </h1>
        <h1 class="titreForm"> details unspsc: {{$unspsc->details}} <br> id unspsc: {{$unspsc->idUnspsc}} </h1>
        <h1 class="titreForm"> details unspsc: {{$unspscCode->nature}} <br> id unspsc: {{$unspscCode->categorie}} <br>description: {{$unspscCode->description}} </h1>
        <h1 class="titreForm"> details Contact: {{$contact->nom}} <br> </h1>
        <h1 class="titreForm"> details rue: {{$coordonee->rue}}</h1>
        <h1 class="titreForm"> details nom Fichier: {{$file->nomFichier}}</h1>
    
    </div> 
@endif --}}
@endsection
