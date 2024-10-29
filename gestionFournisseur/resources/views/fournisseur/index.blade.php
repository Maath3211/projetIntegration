@extends('layouts.fournisseur')
@section('title',"Page d'accueil")
  @section('navbar')
    <li class="active"><a class="lien" href="{{ route('fournisseur.inscription') }}">Inscription</a></li>
  @endsection
@section('contenu')
<div class="text-center">
    <h1>Portail des fournisseurs</h1>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-index">
      <form method="post" action="{{ route('login.neq') }}">
        @csrf
        <fieldset class="field-index">
          <legend>Authentification par numéro NEQ</legend>
          <div class="d-flex flex-column justify-content-center py-5">
            <div class="form-group">
              <label for="neq" class="titreForm">Numéro d'entreprise (NEQ)</label>
              <input type="text" class="form-control control-index" maxlength="10" pattern="\d*" inputmode="numeric" id="neq" placeholder="Numéro d'entreprise (NEQ)" name="neq">
              <a href="{{route('fournisseur.identification')}}" class="link-right">Pas de NEQ?</a>
              @error('neq')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password" class="titreForm">Mot de passe</label>
              <input type="password" class="form-control control-index" id="password" placeholder="Mot de passe" name="password">
              <a href="{{ route('login.resetView') }}" class="link-right">Mot de passe oublié ?</a>
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary">Connexion</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    <div class="col-md-6 col-index">
      <form method="post" action="{{ route('login.email') }}">
        @csrf
        <fieldset class="field-index">
          <legend>Authentification par adresse courriel</legend>
          <div class="d-flex flex-column justify-content-center py-5">
            <div class="form-group">
              <label for="email" class="titreForm">Adresse courriel</label>
              <input type="email" class="form-control control-index" id="email" placeholder="Adresse courriel" name="email">
              <a href="{{route('fournisseur.inscription')}}" class="link-right">NEQ?</a>
              @error('email')
              <span class="text-danger">{{ $message }}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                </svg>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password" class="titreForm">Mot de passe</label>
              <input type="password" class="form-control control-index" id="password" placeholder="Mot de passe" name="password">
              <a href="{{ route('login.resetView') }}" class="link-right">Mot de passe oublié ?</a>
              @error('password')
              <span class="text-danger">{{ $message }}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                </svg>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary">Connexion</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
@endsection
<script src="{{ asset('js/neq.js') }}"></script>