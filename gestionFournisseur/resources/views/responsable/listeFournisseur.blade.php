@extends('layouts.fournisseur')

@section('title', "Fournisseurs")

<header>
    <div>
        <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
    </div>
    <link rel="stylesheet" href="{{ asset('css/listeFournisseur.css') }}">
</header>

@section('contenu')
<div class="container">
    <!-- Search and filter section -->
    <div class="filter-section">
      <div class="checkbox-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="pending" checked>
          <label class="form-check-label" for="pending">En attente</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="accepted" checked>
          <label class="form-check-label" for="accepted">Acceptées</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="refused" checked>
          <label class="form-check-label" for="refused">Refusées</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="to-review" checked>
          <label class="form-check-label" for="to-review">À réviser</label>
        </div>
      </div>

      <div class="search-bar">
        <input type="text" class="form-control search-input" placeholder="Rechercher">
        <button class="btn btn-outline-secondary search-button" type="button" hidden>Rechercher</button>
      </div>
    </div>

    <!-- Product and services section -->
    <div class="filter-section row">
      <div class="col-md-3 col-12 mb-3">
        <label for="products" class="form-label">Produits et services</label>
        <select id="unspsc" name="unspsc" class="form-select" multiple>
          <option value="" selected>Aucun</option>
          @foreach($unspsc as $supplierUnspscCollection)
          @foreach($supplierUnspscCollection as $des)
              <option>{{ $des->description }}</option>
          @endforeach
          @endforeach
        </select>
      </div>

      <!-- Categories section -->
      <div class="col-md-3 col-12 mb-3">
        <label for="categories" class="form-label">Catégories de travaux</label>
        <select id="rbq" name="rbq" class="form-select" multiple>
          <option value="" selected>Aucun</option>
        @foreach($codes as $code)
            <option>{{ $code->nom }}</option>
        @endforeach
        </select>
      </div>

      <!-- Administrative regions section -->
      <div class="col-md-3 col-12 mb-3">
        <label for="regions" class="form-label">Régions administratives</label>
        <select id="regions" name="regions" class="form-select">
          <option value="">Aucun</option>
          @foreach ($nomRegion as $coo)
          <option>{{ $coo }}</option>
          @endforeach
        </select>
      </div>

      <!-- Cities section -->
      <div class="col-md-3 col-12 mb-3">
        <label for="cities" class="form-label">Villes</label>
        <select class="form-control" id="villes" name="villes">
            <option value="">Aucun</option>
            @foreach ($villes as $ville)
              <option>{{ $ville }}</option>
            @endforeach
        </select>
      </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="text-center py-3">
                <h1>Demande de fournisseur</h1>
                <div class="table-responsive">
                    <table class="table table-hover table-striped shadow-sm">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Entreprise</th>
                            <th scope="col">Courriel</th>
                            <th scope="col">NEQ</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Ville</th>
                            <th scope="col" hidden>RBQ id</th>
                            <th scope="col" hidden>unspsc</th>
                            <th scope="col">Selectionner</th>
                        </tr>
                        </thead>

                        @foreach ($fnAttentes as $fn)
                        <tr class="fournisseur-row" data-statut="{{ $fn->statut }}">
                            <td>{{ $fn->entreprise }}</td>
                            <td>{{ $fn->email }}</td>
                            <td>{{ $fn->neq }}</td>
                            <td>{{ $fn->statut }}</td>
        
                            @php
                                $coord = $coordonnees->firstWhere('fournisseur_id', $fn->id);
                            @endphp
                            <td>{{ $coord ? $coord->ville : 'Non disponible' }}</td>
        
                            @php
                                $rbqLicence = $rbq->firstWhere('fournisseur_id', $fn->id);
                                $rbqCategorieNom = $rbqLicence ? $rbqCategorie->firstWhere('id', $rbqLicence->idCategorie)->nom ?? 'Non disponible' : 'Non disponible';
                            @endphp
                            <td hidden>{{ $rbqCategorieNom }}</td>
        
                            <!-- Afficher les codes UNSPSC associés -->
                            <td hidden>
                                @if (isset($unspsc[$fn->id]))
                                    @foreach ($unspsc[$fn->id] as $code)
                                        {{ $code->code }} - {{ $code->description }}<br>
                                    @endforeach
                                @else
                                    Non disponible
                                @endif
                            </td>
                            <td><input type="checkbox" class="select-fournisseur" value='{{$fn->id}}'></td>
        
                            <td>
                                <a href="{{ route('responsable.demandeFournisseurZoom', $fn->email) }}" class="btn btn-info">
                                    Plus d'information
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <button id="showSelectedBtn" class="btn btn-primary mb-3">Afficher les informations des fournisseurs sélectionnés</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/Responsable/listeFournisseur.js') }}"></script>
@endsection
