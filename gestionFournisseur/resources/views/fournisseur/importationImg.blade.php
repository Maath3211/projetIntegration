@extends('layouts.layoutAdmin')
@section('title', 'Administration')

@section('contenu')
<form action="{{ route('admin.impoImg') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="container-fluid">
        <div class="d-flex row justify-content-center">
            <div class="form-group">
                <label for="imageID">Photo de profil</label>
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="form-group">
                <input type="file" class="form-control-file" name="images[]" multiple >
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="form-group">
                <label for="imageID" class="custom-file-upload">Aucun changement</label>
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="form-group">
                <button class="btn btn-primary btn-lg" id="btnSauvegarder">Enregistrer les modifications</button>
            </div>
        </div>
    </div>
</form>
@endsection
