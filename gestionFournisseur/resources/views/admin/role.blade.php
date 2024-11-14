@extends('layouts.fournisseur')
@section('title', 'Roles')
<link rel="stylesheet" href="{{ asset('css/role.css') }}">
@section('navbar')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" data-boundary="viewport" aria-expanded="false">
        <i class="fas fa-user"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
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
        <div class="row">
            <div class="col-8 offset-2">
                <h2 class="my-4">Liste employés</h2>

                <ul class="list-group">
                    @foreach ($responsables as $responsable)
                        <form class="roleForm" action="{{ route('responsable.editResponsable', $responsable->id) }}" method="post">
                            @csrf
                            <li class="list-group-item d-flex justify-content-between">
                                <h5 class="mb-1">{{ $responsable->email }}</h5>
                                <select id="selectRoles" class="form-control role-select" name="role">
                                    <option value="Commis" {{ $responsable->role == 'Commis' ? 'selected' : '' }}>Commis
                                    </option>
                                    <option value="Responsable" {{ $responsable->role == 'Responsable' ? 'selected' : '' }}>
                                        Responsable</option>
                                    <option value="Administrateur"
                                        {{ $responsable->role == 'Administrateur' ? 'selected' : '' }}>
                                        Administrateur</option>
                                </select>
                            </li>
                        </form>
                    @endforeach
                </ul>
                <form action="{{ route('responsable.addResponsable') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Ajouter</button>
                </form>

                <button class="btn btn-success" onclick="submitForms()">Enregistrer</button>

                <button id="showPopup" class="btn btn-danger">Supprimer</button>
                <div id="popup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <span class="close-button">&times;</span>
                        <div id="popupContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script src="{{ asset('js/role.js') }}"></script>
@endsection
