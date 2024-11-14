@extends('layouts.layoutAdmin')
@section('title', 'Setting')
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
        <div class="col-6 offset-3">
            <div class="text-center py-3">
                <h1>Gestion des paramètres</h1>

                <form action="{{ route('admin.saveSetting') }}" method="post">
                    @csrf
                    <div class="d-flex">
                        <label>Courriel de l'Appro.</label>
                        <input type="email" class="form-control inputCourriel" placeholder="Courriel"
                            name="emailAppro" @if ($settings && $settings->emailAppro) value="{{ $settings->emailAppro }}" @endif required>
                    </div>

                    <div class="d-flex">
                        <label>Délai avant la révision (mois)</label>
                        <input type="number" class="form-control inputChiffre" placeholder="24" name="delaiRev" required @if ($settings && $settings->emailAppro) value="{{ $settings->delaiRev }}" @endif>
                        @error('delaiRev')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="d-flex">
                        <label>Taille maximale des fichiers joints (Mo)</label>
                        <input type="number" class="form-control inputChiffre" placeholder="75" name="tailleMax" required @if ($settings && $settings->emailAppro)value="{{ $settings->tailleMax }}" @endif>
                        @error('tailleMax')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <label>Courriel des finances</label>
                        <input type="email" class="form-control inputCourriel" placeholder="Courriel"
                            name="emailFinance" required  @if ($settings && $settings->emailAppro) value="{{ $settings->emailFinance }} @endif">
                            @error('emailFinance')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <br>
                    <div>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection