@extends('layouts.fournisseur')
@section('title',"Inscription")
@section('contenu')
<div class="stepper mb-5">
  <div class="stepCurrent">1</div>
  <div class="line"></div>
  <div class="step">2</div>
  <div class="line"></div>
  <div class="step">3</div>
  <div class="line"></div>
  <div class="step">4</div>
  <div class="line"></div>
  <div class="step">5</div>
  <div class="line"></div>
  <div class="step">6</div>
  <div class="line"></div>
  <div class="step">7</div>
</div>
<div class="text-center">
    <h1>Numéro NEQ</h1>
</div>
<form method="post" action="{{ route('fournisseur.storeInscription') }}">
  @csrf
  <div class="container-fluid bordure">
    <fieldset class="border p-3">
      <div class="d-flex row justify-content-center">
        <div class="form-group">
          <label for="neq" class="titreForm">Numéro d'entreprise (NEQ)</label>
          <input type="text" class="form-control" maxlength="10" pattern="\d*" inputmode="numeric" id="neq" placeholder="Numéro d'entreprise (NEQ)" name="neq">
          <a href="{{route('fournisseur.identification')}}" class="link-right">Pas de NEQ?</a>
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
          <button type="submit" class="btn btn-secondary">Suivant</button>
        </div>
      </div>
    </fieldset>
  </div>
</form>
@endsection
<script src="{{ asset('js/neq.js') }}"></script>