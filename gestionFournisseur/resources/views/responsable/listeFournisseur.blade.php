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
          <input class="form-check-input" type="checkbox" id="refused">
          <label class="form-check-label" for="refused">Refusées</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="to-review" checked>
          <label class="form-check-label" for="to-review">À réviser</label>
        </div>
      </div>

      <div class="search-bar">
        <input type="text" class="form-control" placeholder="Rechercher">
        <button class="btn btn-outline-secondary" type="button">Rechercher</button>
      </div>
    </div>

    <!-- Product and services section -->
    <div class="filter-section row">
      <div class="col-md-3">
        <label for="products" class="form-label">Produits et services</label>
        <select id="products" class="form-select">
          <option selected>Pelouse</option>
        </select>
      </div>

      <!-- Categories section -->
      <div class="col-md-3">
        <label for="categories" class="form-label">Catégories de travaux</label>
        <select id="categories" class="form-select">
          <option selected>Entrepreneur général</option>
          <option selected>PD</option>
        </select>
      </div>

      <!-- Administrative regions section -->
      <div class="col-md-3">
        <label for="regions" class="form-label">Régions administratives</label>
        <select id="regions" class="form-select">
          <option selected>03 Capitale-Nationale</option>
        </select>
      </div>

      <!-- Cities section -->
      <div class="col-md-3">
        <label for="cities" class="form-label">Villes  .ty5456546 </label>
        <select id="cities" class="form-select">
          <option selected>Batiscan</option>
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
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>

                        
                            @foreach ($fnAttentes as $fn)
                            <tr class="fournisseur-row" data-statut="{{ $fn->statut }}">
                            <td>{{$fn->entreprise}}</td>
                            <td>{{$fn->email}}</td>
                            <td>{{$fn->neq}}</td>
                            <td>{{$fn->statut}}</td>
                            <td> <a href="{{ route('responsable.demandeFournisseurZoom', $fn->neq) }}" class="btn btn-info">Plus d'information</a> </td>
                            </tr>
                        @endforeach
                            
                      </table>



                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/listeFournisseur.js') }}"></script>
@endsection
