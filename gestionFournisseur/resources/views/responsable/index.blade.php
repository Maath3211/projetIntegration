@extends('layouts.layoutAdmin')
@section('title',"Accueil")
@section('contenu')
<div class="text-center">
    <h1>Fournisseurs (Admin/Responsable/Commis)</h1>
</div>
<form method="post" action="{{ route('login.email.responsable') }}">
  @csrf
  <div class="container-fluid bordure">
    <fieldset class="border p-3">
      <div class="d-flex row justify-content-center">
        <div class="form-group">
          <label for="email" class="titreForm">Email
            <small class="text-danger">*</small>
          </label>
          <input type="email" class="form-control" id="email" placeholder="Adresse courriel" name="email">
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
            <label for="role" class="titreForm">Role
                <small class="text-danger">*</small>
            </label>
            <select name="role" class="form-control" id="role" name="role">
                <option value="Commis" {{ old('role') == 'Commis' ? 'selected' : '' }}>Commis</option>
                <option value="Responsable" {{ old('role') == 'Responsable' ? 'selected' : '' }}>Responsable</option>
                <option value="Administrateur" {{ old('role') == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
            </select>
            @error('role')
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
          <button type="submit" class="btn btn-secondary">Connexion</button>
        </div>
      </div>
    </fieldset>
  </div>
</form>
@endsection
