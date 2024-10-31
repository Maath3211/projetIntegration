{{-- TODO: Améliorer le chargement de la page --}}
@extends('layouts.fournisseur')
@section('title',"MOD UNSPSC")
@section('contenu')
<div class="text-center">
    <h1 class="py-5">Mise à jour UNSPSC</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <fieldset>
                <legend>Produits et services offerts</legend>
                <div class="row">
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control mb-3" maxlength="80" id="search-input" name="recherche" placeholder="Rechercher...">
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('fournisseur.UNSPSC.update', $unspscFournisseur->first()->idUnspsc) }}">
                        <div class="col-md-1">
                        </div>
                        @csrf
                        @method('PATCH')
                        @if (count($codes))
                            <div class="scroll-container">
                                @foreach($codes as $code)
                                    <div class="item">
                                        <div class="col-md-1">
                                            <label for="code" class="titreForm">Code
                                                <small class="text-danger">*</small>
                                            </label>
                                            <input type="checkbox" class="mt-2" id="idUnspsc{{ $code->id }}" name="idUnspsc[]" value="{{ $code->id }}" {{ in_array($code->id, $unspscChamp) ? 'checked' : '' }}>
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
                                <textarea name="details" id="details" class="form-control" maxlength="500">{{ old('details', $unspscDetails->details) }}</textarea>
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
                </div>
            </fieldset>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fuse.js@6.4.6/dist/fuse.basic.min.js"></script>
<script src="{{ asset('js/UnspscPage.js') }}"></script>
@endsection
