@extends('layouts.fournisseur')

@section('title', "Page d'accueil")

<header>
    <div>
        <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>
    </div>
</header>

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <fieldset>
                <legend>Licence RBQ</legend>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Numéro de licence RBQ</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Statut</h5>
                    </div>
                </div>

                <form method="POST" action="{{ route('fournisseur.storeRBQ') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" maxlength="12" id="search-input" name="licenceRBQ" placeholder="####-####-##">
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="statut">
                                <option value="Valide">Valide</option>
                                <option value="Valide avec restriction">Valide avec restriction</option>
                                <option value="Non valide">Non valide</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-5">
                            <h5>Type de licence</h5>
                        </div>
                        <div class="col-md-7">
                            <select class="form-control" name="typeLicence">
                                <option value="Entrepreneur">Entrepreneur</option>
                                <option value="Constructeur-Propriétaire">Constructeur-Propriétaire</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="pl-5">Catégorie et sous-catégories autorisées</h5>
                        
                        @if (count($codes)) 
                            <div class="scroll-container">
                                @foreach($codes as $code)
                                    <div class="item">
                                        <div class="col-md-1">
                                            <input type="radio" class="mt-2" id="Categorie" name="idCategorie" value="{{ $code->id }}">
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
@endsection
