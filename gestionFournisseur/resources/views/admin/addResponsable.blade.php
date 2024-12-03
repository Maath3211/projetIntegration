@extends('layouts.layoutAdmin')
@section('title', 'Ajout responsable')
<link rel="stylesheet" href="{{ asset('css/role.css') }}">
@section('navbar')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
            data-boundary="viewport" aria-expanded="false">
            <i class="fas fa-user"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
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
                <div class="col-md-6 offset-md-3 col-10 offset-1">
                    <h1 class="my-4">Ajout d'un employé</h1>
                    <form action="{{ route('responsable.storeResponsable') }}" method="POST">
                        @csrf

                        <input type="text" class="form-control addEmail" placeholder="Courriel" name="email" required
                            value="{{ old('email') }}">

                        <select id="selectRoles" class="form-control addRoles" name="role">
                            <option value="Commis">Commis</option>
                            <option value="Responsable">Responsable</option>
                            <option value="Gestionnaire">Gestionnaire</option>
                        </select>

                        <button type="submit" class="btn btn-secondary">Ajouter</button>
                    </form>


                </div>
            </div>
        </fieldset>
    </div>








@endsection
