@extends('layouts.layoutAdmin')
@section('title', 'Ajout responsable')
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
                <h2 class="my-4">Ajout d'un employé</h2>
                <form action="{{ route('responsable.storeResponsable') }}" method="POST">
                    @csrf

                    <input type="text" class="form-control" placeholder="Courriel" name="email" required
                        value="{{ old('email') }}">

                    <select id="selectRoles" class="form-control" name="role">
                        <option value="Commis">Commis</option>
                        <option value="Responsable">Responsable</option>
                        <option value="Gestionnaire">Gestionnaire</option>
                    </select>

                    <button type="submit" class="btn btn-secondary">Ajouter</button>
                </form>

                
            </div>
        </div>
    </div>








@endsection
