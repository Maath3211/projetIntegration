@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<form action="{{ route('admin.impoImg') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')


    <div class="form-group">
        <label for="imageID">Photo de profil</label>
        
        <input type="file" class="form-control-file" name="image" required>

        <label for="imageID" class="custom-file-upload">Aucun changement</label>

        <button class="btn btn-primary btn-lg" id="btnSauvegarder">Enregistrer les modifications</button>
    </div>
</form>
