@extends('layouts.layoutAdmin')
@section('title', 'Administration')

@section('contenu')
<div class="text-center py-5">
    <h1 class="py-5">IMPORTATIONS</h1>
</div>
<form action="{{ route('fournisseur.storeImportation') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="container-fluid">
        <div class="d-flex row justify-content-center">
            <div class="form-group">
                <label for="imageID" class="titreForm">Photo de profil
                    <small class="text-muted">(Optionnel)</small>
                </label>
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="form-group">
                <label for="fichier" class="titreForm">Fichiers
                    <small class="text-danger">*</small>
                  </label>
                <input type="file" class="form-control-file" name="images[]" multiple >
                @error('images')
                <span class="text-danger">{{ $message }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                      <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                    </svg>
                  </span>
                @enderror
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="form-group" class="titreForm">
                <label for="imageID" class="custom-file-upload">Aucun changement</label>
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="form-group">
              <button type="submit" class="btn btn-secondary">Enregistrer</button>
            </div> 
        </div> 
    </div>
</form>
@endsection
