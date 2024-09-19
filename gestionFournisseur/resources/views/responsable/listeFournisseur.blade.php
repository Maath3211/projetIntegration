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
        <div class="form-check mt-2">
          <input class="form-check-input" type="checkbox" id="option1">
          <label class="form-check-label" for="option1">Rouleuses pour pelouses et terrains</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="option2">
          <label class="form-check-label" for="option2">Scarificateur de pelouse</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="option3">
          <label class="form-check-label" for="option3">Services d'entretien des pelouses</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="option4">
          <label class="form-check-label" for="option4">Service d'entretien des pelouses d'autoroutes</label>
        </div>
      </div>

      <!-- Categories section -->
      <div class="col-md-3">
        <label for="categories" class="form-label">Catégories de travaux</label>
        <select id="categories" class="form-select">
          <option selected>Entrepreneur général</option>
        </select>
        <div class="form-check mt-2">
          <input class="form-check-input" type="checkbox" id="category1" checked>
          <label class="form-check-label" for="category1">1.4 Routes et canalisation</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="category2" checked>
          <label class="form-check-label" for="category2">1.5 Structures d'ouvrage de génie civil</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="category3">
          <label class="form-check-label" for="category3">2.5 Excavation et terrassement</label>
        </div>
      </div>

      <!-- Administrative regions section -->
      <div class="col-md-3">
        <label for="regions" class="form-label">Régions administratives</label>
        <select id="regions" class="form-select">
          <option selected>03 Capitale-Nationale</option>
        </select>
        <div class="form-check mt-2">
          <input class="form-check-input" type="checkbox" id="region1">
          <label class="form-check-label" for="region1">01 Bas-Saint-Laurent</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="region2">
          <label class="form-check-label" for="region2">02 Saguenay-Lac-Saint-Jean</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="region3" checked>
          <label class="form-check-label" for="region3">03 Capitale-Nationale</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="region4">
          <label class="form-check-label" for="region4">04 Mauricie</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="region5">
          <label class="form-check-label" for="region5">05 Estrie</label>
        </div>
      </div>

      <!-- Cities section -->
      <div class="col-md-3">
        <label for="cities" class="form-label">Villes</label>
        <select id="cities" class="form-select">
          <option selected>Batiscan</option>
        </select>
        <div class="form-check mt-2">
          <input class="form-check-input" type="checkbox" id="city1" checked>
          <label class="form-check-label" for="city1">Batiscan</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="city2">
          <label class="form-check-label" for="city2">Beaupré</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="city3">
          <label class="form-check-label" for="city3">Boischatel</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="city4">
          <label class="form-check-label" for="city4">Cap-Santé</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="city5">
          <label class="form-check-label" for="city5">Champlain</label>
        </div>
      </div>
    </div>
  </div>

@endsection
