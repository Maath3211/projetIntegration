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

<div class="container-fluid bordureUNSPSC" id="unspsc-page">
            <fieldset class="border">
                <legend>Produits et services offerts</legend>
                <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="search-input" placeholder="Rechercher un code ou une description...">
                        <h1 id="search-message" class="">Effectuer une recherche</h1>
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('fournisseur.storeUnspsc') }}">
                        @csrf
                        @if (count($codes))
                    <div class="test">
                        <div class="scroll-container" id="unspsc-items" style="display: none;">
                        <h1 id="no-results-message" class="text-muted RechercheUnspsc"  style="display: none;">Effectuer une recherche</h1>

                            @foreach($codes as $code)
                            <div class="item">
                                <div class="col-md-2">
                                <div class="custom-checkbox-container">
                                    <label for="idUnspsc{{ $code->id }}" class="custom-checkbox-label">
                                        <input type="checkbox" class="custom-checkbox" id="idUnspsc{{ $code->id }}" name="idUnspsc[]" value="{{ $code->id }}" {{ in_array($code->id, old('idUnspsc', [])) ? 'checked' : '' }}>
                                        <span class="checkbox-custom"></span>
                                        Code <small class="text-danger">*</small>
                                    </label>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <p>{{ $code->code }}</p>
                                </div>
                                <div class="col-md-7">
                                    <p>{{ $code->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        </div>
                        <p id="no-results-message" class="text-muted" style="display: none;">Effectuer une recherche</p>
                    @else
                        <p>Erreur : aucun service public proposé</p>
                    @endif
                    @error('idUnspsc')
                    <span class="text-danger">{{ $message }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                          <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                        </svg>
                      </span>
                    @enderror
                    {{-- {{ $codes->links() }} --}}
                    <div class="row">
                        <h5 class="pl-5">Détails et spécifications
                        </h5>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <textarea name="details" id="details" class="form-control" maxlength="500">{{ old('details') }}</textarea>
                            @error('details')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror

                        </div>
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
        <div class="col-md-2"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fuse.js@6.4.6/dist/fuse.basic.min.js"></script>
<script src="{{ asset('js/UnspscPage.js') }}"></script>
@endsection
