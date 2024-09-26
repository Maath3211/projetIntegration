@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">


<header>
    <div>

    </div>
</header>

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