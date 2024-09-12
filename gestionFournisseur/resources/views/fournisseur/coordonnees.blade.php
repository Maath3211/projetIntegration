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
                            <input type="text" class="form-control" id="noCivic" placeholder="N Civique" name="noCivic" value="{{old('noCivic')}}">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="rue" class="titreForm">Rue</label>
                            <input type="text" class="form-control" id="rue" placeholder="rue" name="rue" value="{{old('rue')}}">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="bureau" class="titreForm">Bureau</label>
                            <input type="text" class="form-control" id="bureau" placeholder="bureau" value="{{old('bureau')}}">
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="ville" class="titreForm">Ville</label>
                            @if(isset($villes) && count($villes) > 0)
                            <select class="form-control" id="ville" name="ville">
                                <option value="">Sélectionnez une ville</option>
                                @foreach($villes as $ville)
                                <option value="{{ $ville }}" {{ old('ville') == $ville ? 'selected' : '' }}>{{ $ville }}</option>
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
                                <option value="Alberta" {{ old('province') == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                                <option value="Colombie-Britannique" {{ old('province') == 'Colombie-Britannique' ? 'selected' : '' }}>Colombie-Britannique</option>
                                <option value="Île-du-prince-Édouard" {{ old('province') == 'Île-du-prince-Édouard' ? 'selected' : '' }}>Île-du-prince-Édouard</option>
                                <option value="Manitoba" {{ old('province') == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                                <option value="Nouveau-Brunswick" {{ old('province') == 'Nouveau-Brunswick' ? 'selected' : '' }}>Nouveau-Brunswick</option>
                                <option value="Nouvelle-Écosse" {{ old('province') == 'Nouvelle-Écosse' ? 'selected' : '' }}>Nouvelle-Écosse</option>
                                <option value="Ontario" {{ old('province') == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                                <option value="Québec" {{ old('province', 'Québec') == 'Québec' ? 'selected' : '' }}>Québec</option>
                                <option value="Saskatchewan" {{ old('province') == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                                <option value="Terre-Neuve-et-Labrador" {{ old('province') == 'Terre-Neuve-et-Labrador' ? 'selected' : '' }}>Terre-Neuve-et-Labrador</option>
                                <option value="Territoires du Nord-Ouest" {{ old('province') == 'Territoires du Nord-Ouest' ? 'selected' : '' }}>Territoires du Nord-Ouest</option>
                                <option value="Nunavut" {{ old('province') == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                                <option value="Yukon" {{ old('province') == 'Yukon' ? 'selected' : '' }}>Yukon</option>
                            </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="codePostal" class="titreForm">Code Postal</label>
                            <input type="text" class="form-control" id="codePostal" placeholder="Code postal" name="codePostal" value="{{old('codePostal')}}">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group"></label>
                            <label for="site" class="titreForm">Site internet</label>
                            <input type="url" class="form-control" id="site" placeholder="Votre site internet" name="site" value="{{old('site')}}">   
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fieldset">
                    <legend>Téléphone(s)</legend>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="typeTel" class="titreForm">Type</label>
                            <select name="typeTel" class="form-control" id="typeTel" name="typeTel">
                                <option value="Bureau" {{ old('typeTel2') == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                                <option value="Télécopieur" {{ old('typeTel2') == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                                <option value="Cellulaire" {{ old('typeTel2') == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                            </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="numero" class="titreForm">Numero</label>
                            <input type="text" class="form-control telephones" id="numero" placeholder="555-555-5555" name="numero" maxlength="12" value="{{old('numero')}}">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="poste" class="titreForm">Poste</label>
                            <input type="text" class="form-control" id="poste" placeholder="" name="poste" value="{{old('poste')}}">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="typeTel2" class="titreForm">Type</label>
                            <select name="typeTel2" class="form-control" id="typeTel2">
                            <option value="" {{ old('typeTel2') == '' ? 'selected' : '' }}>-- Sélectionnez un type --</option>
                            <option value="Bureau" {{ old('typeTel2') == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                            <option value="Télécopieur" {{ old('typeTel2') == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                            <option value="Cellulaire" {{ old('typeTel2') == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                        </select>
                        </div> 
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="numero2" class="titreForm">Numero</label>
                            <input type="text" class="form-control telephones" id="numero2" placeholder="555-555-5555" name="numero2" maxlength="12" value="{{old('numero2')}}">
                        </div>
                    </div>
                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="poste2" class="titreForm">Poste</label>
                            <input type="text" class="form-control" id="poste2" placeholder="" name="poste2" value="{{old('poste2')}}">
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