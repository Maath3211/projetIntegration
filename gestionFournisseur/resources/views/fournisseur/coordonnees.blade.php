@extends('layouts.fournisseur')
@section('title',"Coordonnées")
<header>
<div>
    <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
</div>
</header>
@section('contenu')
<div class="text-center py-5">
    <h1 class="py-5">Coordonnées</h1>
</div>
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
                            @if(isset($villes) && count($villes) > 0)
                            <select class="form-control" id="ville" name="ville">
                                <option value="">Sélectionnez une ville</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville }}">{{ $ville }}</option>
                                @endforeach
                            </select>
                             @else
                                <p>Aucune ville disponible.</p>
                             @endif
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="province" class="titreForm">Province</label>
                            <select name="province" class="form-control" id="province">
                                <option value="Québec"selected>Québec</option>
                                <option value="Ontario">Ontario</option>
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
                                <option value="Bureau">Bureau</option>
                                <option value="Télécopieur">Télécopieur</option>
                                <option value="Cellulaire">Cellulaire</option>
                            </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="numero" class="titreForm">Numero</label>
                            <input type="text" class="form-control telephones" id="numero" placeholder="555-555-5555" name="numero" maxlength="12">
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
                            <label for="typeTel2" class="titreForm">Type</label>
                            <select name="typeTel2" class="form-control" id="typeTel2">
                                <option value="" selected>-- Sélectionnez un type --</option>
                                <option value="Bureau">Bureau</option>
                                <option value="Télécopieur">Télécopieur</option>
                                <option value="Cellulaire">Cellulaire</option>
                            </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="numero2" class="titreForm">Numero</label>
                            <input type="text" class="form-control telephones" id="numero2" placeholder="555-555-5555" name="numero2" maxlength="12">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="poste2" class="titreForm">Poste</label>
                            <input type="text" class="form-control" id="poste2" placeholder="" name="poste2">
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
<script src="{{ asset('js/numTelephone.js') }}"></script>