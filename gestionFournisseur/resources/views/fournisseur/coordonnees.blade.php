@extends('layouts.fournisseur')
@section('title',"Coordonnées")
<header>
<div>
    <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
</div>
</header>
<div class="text-center py-5">
    <h1 class="py-5">Coordonnées</h1>
</div>
@section('contenu')
<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('fournisseur.coordonnees') }}">
                @csrf
                <fieldset class="fieldset">
                    <legend>Adresse</legend>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="noCivic" class="titreForm">N Civique</label>
                            <input type="text" class="form-control" id="noCivic" placeholder="noCivic" name="noCivic">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="rue" class="titreForm">Rue</label>
                            <input type="text" class="form-control" id="rue" placeholder="rue" name="rue">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="bureau" class="titreForm">Bureau</label>
                            <input type="text" class="form-control" id="bureau" placeholder="bureau" name="bureau">
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="ville" class="titreForm">Ville</label>
                            <input type="text" class="form-control" id="ville" placeholder="ville" name="ville">
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="province" class="titreForm">Province</label>
                            <select name="province" class="form-control" id="province">
                                <option value="quebec">Québec</option>
                            </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="codePostal" class="titreForm">Code Postal</label>
                            <input type="text" class="form-control" id="codePostal" placeholder="code postal" name="codePostal">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group"></label>
                            <label for="site" class="titreForm">Site internet</label>
                            <input type="url" class="form-control" id="site" placeholder="Votre site internet" name="site">   
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fieldset">
                    <legend>Téléphone(s)</legend>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="typeTel" class="titreForm">Type</label>
                            <select name="typeTel" class="form-control" id="typeTel" name="typeTel">
                                <option value="01">Bureau</option>
                                <option value="02">Télécopieur</option>
                                <option value="03">Cellulaire</option>
                            </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="numero" class="titreForm">Numero</label>
                            <input type="text" class="form-control" id="numero" placeholder="" name="numero">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="poste" class="titreForm">Poste</label>
                            <input type="text" class="form-control" id="poste" placeholder="" name="poste">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <button type="button">+</button>
                        </div>
                    </div>
                </fieldset>
                <div class="d-flex row justify-content-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary">Précédent</button>
                        <button type="submit" class="btn btn-secondary">Suivant</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
