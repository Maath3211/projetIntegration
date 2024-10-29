@extends('layouts.fournisseur')

@section('title', "Fournisseurs")

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
        .checkbox-group {
          display: flex;
          gap: 10px;
          align-items: center;
        }
        .form-check {
          margin: 0 10px;
        }
        .form-select, .form-control {
          width: 100%;
        }
        .filter-section {
          border: 1px solid #000;
          padding: 10px;
          margin-top: 10px;
        }
        .filter-section > div {
          margin-bottom: 15px;
        }
        .search-bar {
          display: flex;
          align-items: center;
        }
      </style>
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
        <button class="btn btn-outline-secondary search-button" type="button">Rechercher</button>
      </div>
    </div>

    <!-- Product and services section -->
    <div class="filter-section row">
      <div class="col-md-3">
        <label for="products" class="form-label">Produits et services</label>
        <select id="unspsc" name="unspsc" class="form-select" multiple>
          <option value="" selected>Aucun</option>
        @foreach($unspscDescription as $des)
            <option>{{ $des->description }}</option>
        @endforeach
        </select>
      </div>

      <!-- Categories section -->
      <div class="col-md-3">
        <label for="categories" class="form-label">Catégories de travaux</label>
        <select id="rbq" name="rbq" class="form-select" multiple>
          <option value="" selected>Aucun</option>
        @foreach($codes as $code)
            <option>{{ $code->codeSousCategorie }} : {{ $code->nom }}</option>
        @endforeach
        </select>
      </div>

      <!-- Administrative regions section -->
      <div class="col-md-3">
        <label for="regions" class="form-label">Régions administratives</label>
        <select id="regions" name="regions" class="form-select">
          <option value="">Aucun</option>
          @foreach ($nomRegion as $coo)
          <option >{{ $coo }}</option>
          @endforeach
        </select>
      </div>

      <!-- Cities section -->
      <div class="col-md-3">
        <label for="cities" class="form-label">Villes  .ty5456546 </label>
          <select class="form-control" id="villes" name="villes">
              <option value="">Aucun</option>
              @foreach ($villes as $ville)
                <option >{{ $ville }}</option>
              @endforeach
          </select>
      </div>
    </div>
  </div>




  <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="text-center py-3">
                    <h1>Demande de fournisseur</h1>
        <table class="table table-hover table-striped">
          <tr>
              <th scope="col">Entreprise</th>
              <th scope="col">Courriel</th>
              <th scope="col">NEQ</th>
              <th scope="col">Statut</th>
              <th scope="col">Ville</th>
              <th scope="col">RBQ id</th>
              <th scope="col">unspsc</th>
          </tr>

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
              <td>{{ $rbqCategorieNom }}</td>
      
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
      
              <td>
                  <a href="{{ route('responsable.demandeFournisseurZoom', $fn->neq) }}" class="btn btn-info">
                      Plus d'information
                  </a>
              </td>
          </tr>
      @endforeach
      
      

      </table>
      <a href="{{ route('export.csv') }}" class="btn btn-primary mb-3">Exporter en CSV</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/listeFournisseur.js') }}"></script>
@endsection
