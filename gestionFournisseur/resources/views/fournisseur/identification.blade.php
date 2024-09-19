@extends('layouts.fournisseur')
@section('title',"Identification")
<header>
<div>
    <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
</div>
</header>
@section('contenu')
<div class="text-center py-5">
    <h1>Inscription Fournisseur ( IDENTIFICATION )</h1>
</div>
<form method="post" action="{{route('fournisseur.storeIdentification')}}">
  @csrf
    <div class="d-flex row justify-content-center">
      <div class="form-group">
        <label for="neq" class="titreForm">Numéro d'entreprise (NEQ)</label>
        <input type="text" class="form-control" maxlength="10" pattern="\d*" inputmode="numeric" id="neq" placeholder="Numéro d'entreprise (NEQ)" name="neq" value="{{old('neq')}}">
      </div> 
    </div> 
    <div class="d-flex row justify-content-center">
      <div class="form-group">
        <label for="prenom" class="titreForm">Nom d'entreprise</label>
        <input type="text" class="form-control" id="entreprise" placeholder="Nom d'entreprise" name="entreprise" value="{{old('entreprise')}}">
      </div> 
    </div> 
    <div class="d-flex row justify-content-center">
      <div class="form-group">
        <label for="email" class="titreForm">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Adresse courriel" name="email" value="{{old('email')}}">
      </div> 
    </div> 
    <div class="d-flex row justify-content-center">
    <div class="form-group">
      <label for="password" class="titreForm">Choisir un mot de passe</label>
      <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
    </div> 
  </div>
  <div class="d-flex row justify-content-center">
    <div class="form-group">
      <label for="confirmPassword" class="titreForm">Resaisir le mot de passe</label>
      <input type="password" class="form-control" id="confirmPassword" placeholder="Mot de passe" name="confirmPassword">
    </div> 
  </div> 
    <div class="d-flex row justify-content-center">
      <div class="form-group">
        <button type="submit" class="btn btn-secondary">Inscription</button>
      </div> 
    </div> 
</form>
@endsection
<script src="{{ asset('js/neq.js') }}"></script>