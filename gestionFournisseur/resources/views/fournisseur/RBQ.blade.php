@extends('layouts.fournisseur')
@section('title', "RBQ")
@section('contenu')
<div class="text-center">
    <h1>RBQ</h1>
</div>
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
                            </h5>
                            <input type="text" value="{{ $numRBQ ?? old('licenceRBQ') }}" id="search-input" name="licenceRBQ" class="form-control" maxlength="12" placeholder="####-####-##">
                            @error('licenceRBQ')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <h5>Statut
                            </h5>
                            <select class="form-control" name="statut">
                                <option value="Aucun" {{ $typeLicence == 'Aucun' ? 'selected' : '' }}>Aucun</option>
                                <option value="Valide" {{ $statutRBQ == 'Active' && $restriction == 'Non' ? 'selected' : '' }}>Valide</option>
                                <option value="Valide avec restriction" {{ $statutRBQ == 'Active' && $restriction == 'Oui' ? 'selected' : '' }}>Valide avec restriction</option>
                                <option value="Non valide" {{ $statutRBQ == 'Non valide' ? 'selected' : '' }}>Non valide</option>
                            </select>
                            @error('statut')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-5">
                            <h5>Type de licence
                            </h5>
                        </div>
                        <div class="col-md-7">
                            <select class="form-control" name="typeLicence">
                                <option value="Aucun" {{ $typeLicence == 'Aucun' ? 'selected' : '' }}>Aucun</option>
                                <option value="Entrepreneur" {{ $typeLicence == 'Entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                                <option value="Constructeur-Propriétaire" {{ $typeLicence == 'Constructeur-proprietaire' ? 'selected' : '' }}>Constructeur-propriétaire</option>
                            </select>
                            @error('typeLicence')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row py-5">
                        <h5 class="pl-5">Catégories et sous-catégories autorisées
                        </h5>
                        
                        @if (count($codes)) 
                            <div class="scroll-container">
                                @foreach($codes as $code)
                                    <div class="item">
                                        <div class="col-md-1">
                                            <input type="radio" class="mt-2" id="Categorie" name="idCategorie" value="{{ $code->id }}" {{ $sousCategories == $code->codeSousCategorie ? 'checked' : '' }}>
                                            @error('idCategorie')
                                            <span class="text-danger">{{ $message }}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                                </svg>
                                              </span>
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
                            <button type="submit" class="btn btn-secondary">Précédent</button>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary">Suivant</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>
@endsection
<script src="{{ asset('js/RBQ.js') }}"></script>

