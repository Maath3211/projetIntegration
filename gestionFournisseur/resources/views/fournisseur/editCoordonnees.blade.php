@extends('layouts.fournisseur')
@section('title',"MOD Coordonnées")
@section('contenu')
<div class="text-center">
    <h1>Coordonnées</h1>
</div>
<form method="post" action="{{ route('fournisseur.coordonnees.update', ['id' => $fournisseur->id]) }}"> <!-- MOD ICI -->
    @csrf
    <input type="hidden" name="fournisseur_id" value="{{ $fournisseur->id }}">
    <div class="container-fluid bordure">
        <fieldset class="border p-3">
            <legend>Adresse</legend>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="noCivic" class="titreForm">N Civique
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" id="noCivic" placeholder="N Civique" name="noCivic" value="{{ old('noCivic', $coordonnees->noCivic) }}">
                    @error('noCivic')
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
                    <label for="rue" class="titreForm">Rue
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" id="rue" placeholder="Rue" name="rue" value="{{ old('rue', $coordonnees->rue) }}">
                    @error('rue')
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
                    <label for="bureau" class="titreForm">Bureau
                        <small class="text-muted">(Optionnel)</small>
                    </label>
                    <input type="text" class="form-control" id="bureau" placeholder="Bureau" name="bureau" value="{{old('bureau', $coordonnees->bureau)}}">
                    @error('bureau')
                    <span class="text-danger">{{ $message }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                        </svg>
                        </span>
                    @enderror
                </div> 
            </div>
            <div class="d-flex row justify-content-center" id="villeContainer">
                <div class="form-group">
                    <label for="ville" class="titreForm">Ville
                        <small class="text-danger">*</small>
                    </label>
                    @if(isset($villes) && count($villes) > 0)
                    <select class="form-control" id="ville" name="ville">
                        <option value="">Sélectionnez une ville</option>
                        @foreach($villes as $ville)
                        <option value="{{ $ville }}" {{ old('ville') == $ville || (isset($coordonnees->ville) && $coordonnees->ville == $ville) ? 'selected' : '' }}>{{ $ville }}</option>
                        @endforeach
                    </select>
                        @else
                        <input type="text" class="form-control" id="villeInput" name="ville" placeholder="Entrez la ville" value="{{ old('ville', $coordonnees->ville) }}">
                        @endif
                        <input type="text" class="form-control" id="villeInput" name="ville" placeholder="Entrez la ville" style="display: none;">
                        @error('ville')
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
                    <label for="province" class="titreForm">Province
                        <small class="text-danger">*</small>
                    </label>
                    <select name="province" class="form-control" id="province">
                        <option value="Alberta" {{ old('province', $coordonnees->province ?? '') == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                        <option value="Colombie-Britannique" {{ old('province', $coordonnees->province ?? '') == 'Colombie-Britannique' ? 'selected' : '' }}>Colombie-Britannique</option>
                        <option value="Île-du-prince-Édouard" {{ old('province', $coordonnees->province ?? '') == 'Île-du-prince-Édouard' ? 'selected' : '' }}>Île-du-prince-Édouard</option>
                        <option value="Manitoba" {{ old('province', $coordonnees->province ?? '') == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                        <option value="Nouveau-Brunswick" {{ old('province', $coordonnees->province ?? '') == 'Nouveau-Brunswick' ? 'selected' : '' }}>Nouveau-Brunswick</option>
                        <option value="Nouvelle-Écosse" {{ old('province', $coordonnees->province ?? '') == 'Nouvelle-Écosse' ? 'selected' : '' }}>Nouvelle-Écosse</option>
                        <option value="Ontario" {{ old('province', $coordonnees->province ?? '') == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                        <option value="Québec" {{ old('province', $coordonnees->province ?? 'Québec') == 'Québec' ? 'selected' : '' }}>Québec</option>
                        <option value="Saskatchewan" {{ old('province', $coordonnees->province ?? '') == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                        <option value="Terre-Neuve-et-Labrador" {{ old('province', $coordonnees->province ?? '') == 'Terre-Neuve-et-Labrador' ? 'selected' : '' }}>Terre-Neuve-et-Labrador</option>
                        <option value="Territoires du Nord-Ouest" {{ old('province', $coordonnees->province ?? '') == 'Territoires du Nord-Ouest' ? 'selected' : '' }}>Territoires du Nord-Ouest</option>
                        <option value="Nunavut" {{ old('province', $coordonnees->province ?? '') == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                        <option value="Yukon" {{ old('province', $coordonnees->province ?? '') == 'Yukon' ? 'selected' : '' }}>Yukon</option>
                    </select>
                    @error('province')
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
                    <label for="codePostal" class="titreForm">Code Postal
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" id="codePostal" placeholder="Code postal" name="codePostal" value="{{old('codePostal', $codePostal)}}">
                    @error('codePostal')
                    <span class="text-danger">{{ $message }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                        </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group"></label>
                    <label for="site" class="titreForm">Site internet
                        <small class="text-muted">(Optionnel)</small>
                    </label>
                    <input type="url" class="form-control" id="site" placeholder="Votre site internet" name="site" value="{{old('site', $coordonnees->site)}}">
                    @error('site')
                    <span class="text-danger">{{ $message }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                        </svg>
                        </span>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="fieldset">
            <legend>Téléphone(s)</legend>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="typeTel" class="titreForm">Type
                        <small class="text-danger">*</small>
                    </label>
                    <select name="typeTel" class="form-control" id="typeTel" name="typeTel">
                        <option value="Bureau" {{ old('typeTel', $coordonnees->typeTel) == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                        <option value="Télécopieur" {{ old('typeTel', $coordonnees->typeTel) == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                        <option value="Cellulaire" {{ old('typeTel', $coordonnees->typeTel) == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                    </select>
                    @error('typeTel')
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
                    <label for="numero" class="titreForm">Numero
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control telephones" id="numero" placeholder="555-555-5555" name="numero" maxlength="12" value="{{old('numero', $numero)}}">
                    @error('numero')
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
                    <label for="poste" class="titreForm">Poste
                        <small class="text-muted">(Optionnel)</small>
                    </label>
                    <input type="text" class="form-control" id="poste" placeholder="" name="poste" value="{{old('poste', $coordonnees->poste)}}">
                    @error('poste')
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
                    <label for="typeTel2" class="titreForm">Type
                        <small class="text-muted">(Optionnel)</small>
                    </label>
                    <select name="typeTel2" class="form-control" id="typeTel2">
                        <option value="" {{ old('typeTel2') == '' ? 'selected' : '' }}>-- Sélectionnez un type --</option>
                        <option value="Bureau" {{ old('typeTel2', $coordonnees->typeTel2) == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                        <option value="Télécopieur" {{ old('typeTel2', $coordonnees->typeTel2) == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                        <option value="Cellulaire" {{ old('typeTel2', $coordonnees->typeTel2) == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                    </select>
                    @error('type')
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
                    <label for="numero2" class="titreForm">Numero
                        <small class="text-muted">(Optionel)</small>
                    </label>
                    <input type="text" class="form-control telephones" id="numero2" placeholder="555-555-5555" name="numero2" maxlength="12" value="{{old('numero2', $numero2)}}">
                    @error('numero2')
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
                    <label for="poste2" class="titreForm">Poste
                        <small class="text-muted">(Optionnel)</small>
                    </label>
                    <input type="text" class="form-control" id="poste2" placeholder="" name="poste2" value="{{old('poste2', $coordonnees->poste2)}}">
                    @error('poste2')
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
                    <button type="button" class="btn btn-secondary">Précédent</button>
                    <button type="submit" class="btn btn-secondary">Suivant</button>
                </div>
            </div>
        </fieldset>
    </div>
</form>
@endsection

<script src="{{ asset('js/numTelephone.js') }}"></script>
<script src="{{ asset('js/ville.js') }}"></script>

