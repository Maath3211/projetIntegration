@extends('layouts.layoutAdmin')
@section('title', 'Administration')

@section('contenu')
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
                <span class="text-danger">{{ $message }}</span>
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
