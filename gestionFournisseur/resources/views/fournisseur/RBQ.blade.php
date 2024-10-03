@extends('layouts.fournisseur')

@section('title', "RBQ")

<header>
    <div>
        <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <fieldset>
                <legend>Licence RBQ</legend>

                <form method="POST" action="{{ route('fournisseur.storeRBQ') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Numéro de licence RBQ
                                <small class="text-danger">*</small>
                            </h5>
                            <input type="text" value="{{ $numRBQ ?? old('licenceRBQ') }}" id="search-input" name="licenceRBQ" class="form-control" maxlength="12" placeholder="####-####-##">
                            @error('licenceRBQ')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <h5>Statut
                                <small class="text-danger">*</small>
                            </h5>
                            <select class="form-control" name="statut">
                                <option value="Valide" {{ $statutRBQ == 'Active' && $restriction == 'Non' ? 'selected' : '' }}>Valide</option>
                                <option value="Valide avec restriction" {{ $statutRBQ == 'Active' && $restriction == 'Oui' ? 'selected' : '' }}>Valide avec restriction</option>
                                <option value="Non valide" {{ $statutRBQ == 'Non valide' ? 'selected' : '' }}>Non valide</option>
                            </select>
                            @error('statut')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-5">
                            <h5>Type de licence
                                <small class="text-danger">*</small>
                            </h5>
                        </div>
                        <div class="col-md-7">
                            <select class="form-control" name="typeLicence">
                                <option value="Entrepreneur" {{ $typeLicence == 'Entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                                <option value="Constructeur-Propriétaire" {{ $typeLicence == 'Constructeur-proprietaire' ? 'selected' : '' }}>Constructeur-propriétaire</option>
                            </select>
                            @error('typeLicence')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row py-5">
                        <h5 class="pl-5">Catégories et sous-catégories autorisées
                            <small class="text-danger">*</small>
                        </h5>
                        
                        @if (count($codes)) 
                            <div class="scroll-container">
                                @foreach($codes as $code)
                                    <div class="item">
                                        <div class="col-md-1">
                                            <input type="radio" class="mt-2" id="Categorie" name="idCategorie" value="{{ $code->id }}" {{ $sousCategories == $code->codeSousCategorie ? 'checked' : '' }}>
                                            @error('idCategorie')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $code->codeSousCategorie }} : {{ $code->nom }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{ $code->nomCategorie }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Erreur : aucun service public proposé</p>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button class="form-control">Précédent</button>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <button class="form-control">Suivant</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>

<script src="{{ asset('js/RBQ.js') }}"></script>

