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
        <div class="form-group">
          <button type="submit" class="btn btn-secondary">Déconnexion</button>
        </form>
    </nav> 
    

</header>
@section('contenu')



  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="custom-box">
          <h5>État de la demande</h5>
          <p><span class="icon">✔️</span> {{$fournisseur->statut}}</p>
          @if ($fournisseur->statut == 'Inactif')
          <form action="{{ route('fournisseur.storeActive') }}" method="post">
              @csrf
              <div class="form-group">
                  <button type="submit" class="btn btn-secondary">Réactiver mon compte</button>
              </div>
          </form>
          @else
          <form action="{{ route('fournisseur.storeDesactive') }}" method="post">
              @csrf
              <div class="form-group">
                  <button type="submit" class="btn btn-secondary">Retirer mon compte</button>
              </div>
          </form>
          @endif
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

        @if($files && count($files) > 0)
            <div class="custom-box">
                <h5>Documents</h5>
                @foreach($files as $file)
                    <p>
                        <form action="{{ route('fournisseur.deleteFile', $file->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                              </svg>
                            </button>
                        </form>
                        <span class="icon-pdf">📄</span> {{ $file->nomFichier }}  {{ $file->tailleFichier_KO }} Ko  {{ $file->created_at }}
                    </p>
                @endforeach
                <div class="form-group">
                  <a href="{{ route('fournisseur.importation') }}" class="btn btn-secondary">Ajouter un nouveau fichier</a>
                </div>
            </div>
        @else
            <div class="custom-box">
                <h5>Document</h5>
                <p>Aucun document disponible.</p>
                @if($fournisseur->statut != 'Inactif')
                  <div class="form-group">
                    <a href="{{ route('fournisseur.importation') }}" class="btn btn-secondary">Ajouter un fichier</a>
                  </div>
                @endif
            </div>
        @endif
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
