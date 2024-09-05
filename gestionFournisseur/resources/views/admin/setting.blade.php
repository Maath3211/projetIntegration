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
                <h1>Page d'administration</h1>

                <form action="{{ route('admin.saveSetting') }}" method="post">
                    @csrf
                    <div class="d-flex">
                        <label>Courriel de l'appro.</label>
                        <input type="email" class="form-control inputCourriel" placeholder="Courriel"
                            name="emailAppro" value="a@a" required>
                    </div>

                    <div class="d-flex">
                        <label>Délai avant la révision (mois)</label>
                        <input type="number" class="form-control inputChiffre" placeholder="24" name="delaiRev" value="24" required>
                    </div>
                    
                    <div class="d-flex">
                        <label>Taille maximale des fichiers joints (Mo)</label>
                        <input type="number" class="form-control inputChiffre" placeholder="75" name="tailleMax" value="24" required>
                    </div>

                    <div class="d-flex">
                        <label>Courriel des finances</label>
                        <input type="email" class="form-control inputCourriel" placeholder="Courriel"
                            name="emailFinance" value="a@a" required>
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