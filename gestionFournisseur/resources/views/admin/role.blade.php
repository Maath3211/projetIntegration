@extends('layouts.layoutAdmin')
@section('title', 'Roles')
<link rel="stylesheet" href="{{ asset('css/role.css') }}">
@section('navbar')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
            data-boundary="viewport" aria-expanded="false">
            <i class="fas fa-user"></i>
        </a>
        <ul id="ulRole" class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
            <li>
                <form action="{{ route('responsable.listeFournisseur') }}" method="GET" class="px-3 py-2">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-100">Listes fournisseurs</button>
                </form>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
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

    <div class="container-fluid bordure">
        <fieldset class="border">
            <div class="row">
                <div class="col-md-12 col-12 ">
                    <h1 class="my-4 text-center">Liste employés</h1>

                    <ul class="list-group">
                        @foreach ($responsables as $responsable)
                        <form class="roleForm" action="{{ route('responsable.editResponsable', $responsable->id) }}" method="post">
                            @csrf
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-8 mb-2 mb-md-0 email">
                                        <h5 class="mb-1 math">{{ $responsable->email }}</h5>
                                    </div>
                                    <div class="col-12 col-md-4 divRole">
                                        <select id="selectRoles" class="form-control role-select" name="role">
                                            <option value="Commis" {{ $responsable->role == 'Commis' ? 'selected' : '' }}>Commis</option>
                                            <option value="Responsable" {{ $responsable->role == 'Responsable' ? 'selected' : '' }}>Responsable</option>
                                            <option value="Administrateur" {{ $responsable->role == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </form>
                        @endforeach
                    </ul>
                    <form action="{{ route('responsable.addResponsable') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Ajouter</button>
                    </form>

                    <button class="btn btn-secondary" onclick="submitForms()">Enregistrer</button>

                    <button id="showPopup" class="btn btn-danger">Supprimer</button>
                    <div id="popup" class="popup" style="display: none;">
                        <div class="popup-content">
                            <span class="close-button">&times;</span>
                            <div id="popupContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>







    <script src="{{ asset('js/role.js') }}"></script>
@endsection
