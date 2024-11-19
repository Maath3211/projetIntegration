{{-- TODO: Améliorer le chargement de la page --}}
@extends('layouts.fournisseur')
@section('title', "UNSPSC")
@section('contenu')
<div class="stepper mb-5">
    <a href="" class="stepCompleted">1</a>
    <div class="lineCompleted"></div>
    <a href="" class="stepCompleted">2</a>
    <div class="lineCompleted"></div>
    <a href="" class="stepCompleted">3</a>
    <div class="lineCompleted"></div>
    <a href="" class="stepCompleted">4</a>
    <div class="lineCompleted"></div>
    <div class="stepCurrent">5</div>
    <div class="line"></div>
    <div class="step">6</div>
    <div class="line"></div>
    <div class="step">7</div>
</div>

<div class="text-center">
    <h1>UNSPSC</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <fieldset>
                <legend>Produits et services offerts</legend>
                <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="search-input" placeholder="Rechercher un code ou une description...">
                        <small id="search-message" class="text-muted">Effectuer une recherche</small>
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('fournisseur.storeUnspsc') }}">
                        @csrf
                    <div id="unspsc-list" style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                        <div id="unspsc-list">
                            {{-- Affichage des exemples initiaux --}}
                                @foreach($codes as $code)
                                <div class="row item">
                                    <div class="col-md-1">
                                        <input type="checkbox" class="mt-2" id="idUnspsc{{ $code->id }}" name="idUnspsc[]" value="{{ $code->id }}">
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{ $code->code }}</p>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $code->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div id="loading-message" style="display: none;">Chargement...</div>
                        </div>
                    </div>
                        <p id="no-results-message" class="text-muted" style="display: none;">Aucun résultat trouvé</p>

                        <div class="row mt-5">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary">Précédent</button>
                            </div>
                            <div class="col-md-7"></div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-secondary">Suivant</button>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<script src="{{ asset('js/UnspscPage.js') }}"></script>
@endsection
