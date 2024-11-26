@extends('layouts.layoutAdmin')
@section('title', 'Modele courriel')
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
    <link rel="stylesheet" href="{{ asset('css/modelCourriel.css') }}">


    <div class="container-fluid bordure">
        <fieldset class="border">
            <form action="{{ route('responsable.storeModelCourriel') }}" method="post">
                @csrf
                <input name="model" placeholder="Nom du modèle"></input>
                <br>
                <small class="text-muted">Modification est utilisé pour envoyer des courriels quand un fournisseur modifie sa fiche</small>
                
                <div id="templateContent">
                    <label for="sujet">Sujet</label>
                    <textarea name="sujet" id="sujet" cols="50" rows="1"></textarea>
                </div>
                <div id="templateContent">
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" id="contenu" cols="50" rows="10"></textarea>
                </div>



                <button type="submit" class="btn btn-secondary" id="btAccepter">Sauvegarder</button>
            </form>
        </fieldset>
    </div>

@endsection
