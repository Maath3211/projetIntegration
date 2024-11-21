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

<div class="container-fluid" id="unspsc-page">
    <div class="row">
        <div class="col-md-2" ></div>
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
                    <div  style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
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

                        </div>
                    </div>

                        <div class="row">
                            <div id="loading-message" style="display: none;">Chargement...</div>
                            <div id="no-results-message" style="display: none;">Aucun résultats</div>
                            <h5 class="pl-5">Détails et spécifications
                            </h5>
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <textarea name="details" id="details" class="form-control" maxlength="500"></textarea>
                                @error('details')
                                <span class="text-danger">{{ $message }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                      <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                    </svg>
                                  </span>
                                @enderror
                            </div>                            
                            <div class="col-md-1"></div>
                        </div>






                        <div class="row mt-5">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary">Suivant</button>
                            </div>
                            <div class="col-md-7"></div>
                            <div class="col-md-2">
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
