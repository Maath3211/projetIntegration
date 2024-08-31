@extends('layouts.app')
@section('title', 'Administration')

<link rel="stylesheet" href="{{asset('css/admin.css')}}">

<header>
    <div>

    </div>
</header>

<h1>Page d'administration</h1>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">


            <div class="text-center py-5">
                <div class="d-flex">
                    <label>Courriel de l'appro.</label>
                    <input type="text" class="form-control inputCourriel" placeholder="Courriel" name="emailAppro">
                </div>

                <div class="d-flex">
                    <label>Délai avant la révision (mois)</label>
                    <input type="number" class="form-control inputChiffre" placeholder="24" name="delai">
                </div>

                <div class="d-flex">
                    <label>Taille maximale des fichiers joints (Mo)</label>
                    <input type="number" class="form-control inputChiffre" placeholder="75" name="maxSize">
                </div>

                <div class="d-flex">
                    <label>Courriel des finances</label>
                    <input type="text" class="form-control inputCourriel" placeholder="Courriel" name="emailFinance">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
