@extends('layouts.fournisseur')
@section('title',"Informations")
<header>
    <div>
        <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
    </div>
    <nav class="sub-nav">
        <form action="{{ route('fournisseur.logout') }}" method="post">
        @csrf
        <button id="bouton1" type="submit">Déconnecter</button>
        </form>
    </nav> 
</header>
<div class="text-center py-5">
    <h1> TODO: Info Fournisseur ( En construction )</h1>
</div>
@if (isset($fournisseur))
    <div class="container-fluid text-center py-5">
        <h1 class="titreForm"> Page d'informations de NEQ : {{$fournisseur->neq}} EMAIL : {{$fournisseur->email}} ENTREPRISE : {{$fournisseur->entreprise}}</h1>
    </div> 
@endif