@extends('layouts.fournisseur')
@section('title',"Page d'accueil")
<header>
<div>
    <a href="/"><h5 class="compagny">logo</h5></a>
</div>
</header>
@section('contenu')
<div class="text-center py-5">
    <h1>Bienvenue sur le site de ville</h1>
</div>
<div class="container-fluid d-flex justify-content-center align-items-center">
  <div class="row">
      <div class="col-md-12">
      <form method="post" action="{{ route('fournisseur.storeInscription') }}">
        @csrf
        <fieldset>
          <legend>Numéro NEQ ?</legend>
          <div class="d-flex flex-column justify-content-center">
            <div class="form-group">
              <label for="neq" class="titreForm">Numéro d'entreprise (NEQ)</label>
              <input type="text" class="form-control" maxlength="10" pattern="\d*" inputmode="numeric" id="neq" placeholder="Numéro d'entreprise (NEQ)" name="neq">
              <a href="{{route('fournisseur.identification')}}" class="link-right">Pas de NEQ?</a>
              @error('neq')
              <span class="text-danger">{{ $message }}</span>
              @enderror
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
@endsection
<script src="{{ asset('js/neq.js') }}"></script>