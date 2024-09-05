@extends('layouts.fournisseur')
@section('title',"Page d'accueil")
<header>
<div>
    <a href="/"><h5 class="compagny">logo</h5></a>
</div>
<nav class="main-nav d-flex">                 
    <a href="{{route('fournisseur.inscription')}}">Inscription</a>  
</nav>
  </nav>   
</header>
<div class="text-center py-5">
    <h1>Bienvenue sur le site de ville</h1>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <form method="post" action="{{ route('login.neq') }}">
        @csrf
        <fieldset>
          <legend>Authentification</legend>
          <div class="d-flex flex-column justify-content-center py-5">
            <div class="form-group">
              <label for="neq" class="titreForm">Numéro d'entreprise (NEQ)</label>
              <input type="text" class="form-control" maxlength="10" pattern="\d*" inputmode="numeric" id="neq" placeholder="Numéro d'entreprise (NEQ)" name="neq" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
              <a href="#" class="link-right">Pas de NEQ?</a>
            </div>
            <div class="form-group">
              <label for="password" class="titreForm">Mot de passe</label>
              <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
              <a href="#" class="link-right">Mot de passe oublié ?</a>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary">Suivant</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    <div class="col-md-6">
      <form method="post" action="{{ route('login.email') }}">
        @csrf
        <fieldset>
          <legend>Authentification</legend>
          <div class="d-flex flex-column justify-content-center py-5">
            <div class="form-group">
              <label for="email" class="titreForm">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Adresse courielle" name="email">
              <a href="#" class="link-right">NEQ?</a>
            </div>
            <div class="form-group">
              <label for="password" class="titreForm">Mot de passe</label>
              <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
              <a href="#" class="link-right">Mot de passe oublié ?</a>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary">Suivant</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>