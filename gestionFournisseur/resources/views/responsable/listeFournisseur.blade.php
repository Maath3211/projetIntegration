<link rel="stylesheet" href="{{ asset('css/listeFournisseur.css') }}">
@extends('layouts.layoutAdmin')
@section('title', "Info Fournisseurs")
@section('navbar')
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" data-boundary="viewport" aria-expanded="false">
      <i class="fas fa-user"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
    @role(['Administrateur'])
    <li>
        <form action="{{ route('admin.setting') }}" method="GET" class="px-3 py-2">
            @csrf
            <button type="submit" class="btn btn-secondary w-100">Paramètres</button>
        </form>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <form action="{{ route('responsable.addResponsable') }}" method="GET" class="px-3 py-2">
          @csrf
          <button type="submit" class="btn btn-secondary w-100">Ajouter utilisateur</button>
      </form>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <form action="{{ route('responsable.afficherModelCourriel') }}" method="GET" class="px-3 py-2">
          @csrf
          <button type="submit" class="btn btn-secondary w-100">Modèles de courriels</button>
      </form>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <form action="{{ route('responsable.gererResponsable') }}" method="GET" class="px-3 py-2">
          @csrf
          <button type="submit" class="btn btn-secondary w-100">Rôles</button>
      </form>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    @endrole
    <li>
        <form action="{{ route('admin.logout') }}" method="POST" class="px-3 py-2">
            @csrf
            <button type="submit" class="btn btn-secondary w-100">Déconnexion</button>
        </form>
    </li>
  </ul>
</li>
@endsection
@section('contenu')
<div class="container">
    <!-- Search and filter section -->
    @role(['Administrateur','Responsable'])
                                
    <div class="filter-section">
      <div class="checkbox-group">
        <div class="form-check" >
          <input class="form-check-input" type="checkbox" id="pending" checked>
          <label class="form-check-label" for="pending">En attente</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="accepted" checked>
          <label class="form-check-label" for="accepted">Acceptée</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="refused" checked>
          <label class="form-check-label" for="refused">Refusée</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="to-review" checked>
          <label class="form-check-label" for="to-review">À réviser</label>
        </div>
      </div>

      @else
      <div class="filter-section" hidden>
        <div class="checkbox-group">
          <div class="form-check" >
            <input class="form-check-input" type="checkbox" id="pending" checked>
            <label class="form-check-label" for="pending">En attente</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="accepted" checked>
            <label class="form-check-label" for="accepted">Acceptée</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="refused" checked>
            <label class="form-check-label" for="refused">Refusée</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="to-review" checked>
            <label class="form-check-label" for="to-review">À réviser</label>
          </div>
        </div>
      @endrole

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
        <select class="form-control mt-4" id="villes" name="villes">
            <option value="">Aucun</option>
            @foreach ($nomVille as $ville)
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
                            <th scope="col">Statut </th>
                            <th scope="col">Ville</th>
                            <th scope="col" hidden>RBQ id</th>
                            <th scope="col" hidden>unspsc</th>
                            <th scope="col">Selectionner</th>
                            <th scope="col">Information</th>
                        </tr>
                        </thead>

                        @foreach ($fnAttentes as $fn)
                        <tr class="fournisseur-row" data-statut="{{ $fn->statut }}">
                            <td>{{ $fn->entreprise }}</td>
                            <td>{{ $fn->email }}</td>
                            <td>{{ $fn->neq }}</td>
                            <td>

                              @switch($fn->statut)
                                  @case('Acceptée')
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                  </svg>
                                  {{ $fn->statut }}
                                      @break
                                  @case('En attente')
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="#ff8c00" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                  </svg>
                                  {{ $fn->statut }}
                                      @break
                                  @case('Refusée')
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="red" class="bi bi-ban" viewBox="0 0 16 16">
                                    <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                                  </svg>
                                  {{ $fn->statut }}
                                  @break
                                  @case('À réviser')
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                  </svg>
                                  
                                  {{ $fn->statut }}
                                  @break
                                  @default
                                      
                              @endswitch




                            </td>
        
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

                            <td>
                              <div class="custom-checkbox-container">
                                <label for="{{$fn->id}}" class="custom-checkbox-label">
                                    <input type="checkbox" class="select-fournisseur custom-checkbox" value='{{$fn->id}}' id="{{$fn->id}}"> 
                                    <span class="checkbox-custom"></span>        
                                </label>
                              </div>
                            </td>

                              @php
                              $coord = $coordonnees->firstWhere('fournisseur_id', $fn->id);
                          @endphp
                          <td hidden>{{ $coord ? $coord->nomRegion : 'Non disponible' }}</td>
        
                            <td>
                                <a href="{{ route('responsable.demandeFournisseurZoom', $fn->id) }}" class="btn btn-info">
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
