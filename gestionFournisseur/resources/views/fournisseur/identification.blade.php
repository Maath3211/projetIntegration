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
        <label for="neq" class="titreForm">Numéro d'entreprise (NEQ)
          <small class="text-muted">(Optionel)</small>
        </label>
        <input type="text" class="form-control" maxlength="10" pattern="\d*" inputmode="numeric" id="neq" placeholder="Numéro d'entreprise (NEQ)" name="neq" value="{{old('neq', $neq)}}">
        @error('neq')
        <span class="text-danger">{{ $message }}
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
          </svg>
        </span>
        @enderror
      </div> 
    </div> 
    <div class="d-flex row justify-content-center">
      <div class="form-group">
        <label for="prenom" class="titreForm">Nom d'entreprise
          <small class="text-danger">*</small>
        </label>
        <input type="text" class="form-control" id="entreprise" placeholder="Nom d'entreprise" name="entreprise" value="{{old('entreprise', $entrepriseNeq)}}">
        @error('entreprise')
        <span class="text-danger">{{ $message }}
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
          </svg>
        </span>
        @enderror
      </div> 
    </div> 
    <div class="d-flex row justify-content-center">
      <div class="form-group">
        <label for="email" class="titreForm">Email
          <small class="text-danger">*</small>
        </label>
        <input type="email" class="form-control" id="email" placeholder="Adresse courriel" name="email" value="{{old('email', $emailNeq)}}">
        @error('email')
        <span class="text-danger">{{ $message }}
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
          </svg>
        </span>
        @enderror
      </div> 
    </div> 
    <div class="d-flex row justify-content-center">
    <div class="form-group">
      <label for="password" class="titreForm">Choisir un mot de passe
        <small class="text-danger">*</small>
      </label>
      <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
      @error('password')
      <span class="text-danger">{{ $message }}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
          <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
        </svg>
      </span>
      @enderror
    </div> 
  </div>
  <div class="d-flex row justify-content-center">
    <div class="form-group">
      <label for="confirmPassword" class="titreForm">Resaisir le mot de passe
        <small class="text-danger">*</small>
      </label>
      <input type="password" class="form-control" id="confirmPassword" placeholder="Mot de passe" name="password_confirmation">
      @error('password')
      <span class="text-danger">{{ $message }}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
          <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
        </svg>
      </span>
      @enderror
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