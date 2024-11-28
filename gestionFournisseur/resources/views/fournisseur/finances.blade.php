@extends('layouts.fournisseur')
@section('title', "Finances")
@section('contenu')
<div class="text-center py-5">
    <h1>FINANCES</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <fieldset>
                <legend>Finances</legend>
                <form method="POST" action="{{ route('fournisseur.storeFinances') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Numéro de TPS
                                <small class="text-danger">*</small>
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="tps" name="tps" maxlength="9" placeholder="XXXXXXXXX" value="{{ old('tps') }}">
                            @error('tps')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <h5>Numéro de TVQ
                                <small class="text-danger">*</small>
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="tvq" name="tvq" maxlength="16" placeholder="XXXXXXXXXXTQXXXX" value="{{ old('tvq') }}">
                            @error('tvq')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <h5>Conditions de paiement
                                <small class="text-danger">*</small>
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <select class="form-control" name="paiement" id="paiement" value="{{old('paiement')}}">
                                <option value="Aucune option de paiement" {{ old('paiement', 'Aucune option de paiment') == 'Aucune option de paiment' ? 'selected' : '' }}>Aucune option de paiement</option>
                                <option value="Payable immédiatement sans déduction" {{ old('paiement') == 'Payable immédiatement sans déduction' ? 'selected' : '' }}>Payable immédiatement sans déduction</option>
                                <option value="Payable immédiatement sans déduction. Date de base au 15 du mois suivant" {{ old('paiement') == 'Payable immédiatement sans déduction. Date de base au 15 du mois suivant' ? 'selected' : '' }}>Payable immédiatement sans déduction. Date de base au 15 du mois suivant</option>
                                <option value="Dans les 15 jours 2% escompte. dans les 30 jours sans déduction" {{ old('paiement') == 'Dans les 15 jours 2% escompte. dans les 30 jours sans déduction' ? 'selected' : '' }}>Dans les 15 jours 2% escompte, dans les 30 jours sans déduction</option>
                                <option value="Après entrée facture jusqu'au 15 du mois. jusqu'au 15 du mois suivant" {{ old('paiement') == 'Après entrée facture jusqu\'au 15 du mois. jusqu\'au 15 du mois suivant' ? 'selected' : '' }}>Après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant</option>
                                <option value="Dans les 15 jours sans déduction" {{ old('paiement') == 'Dans les 15 jours sans déduction' ? 'selected' : '' }}>Dans les 15 jours sans déduction</option>
                                <option value="Dans les 30 jours sans déduction" {{ old('paiement') == 'Dans les 30 jours sans déduction' ? 'selected' : '' }}>Dans les 30 jours sans déduction</option>
                                <option value="Dans les 45 jours sans déduction" {{ old('paiement') == 'Dans les 45 jours sans déduction' ? 'selected' : '' }}>Dans les 45 jours sans déduction</option>
                                <option value="Dans les 60 jours sans déduction" {{ old('paiement') == 'Dans les 60 jours sans déduction' ? 'selected' : '' }}>Dans les 60 jours sans déduction</option>
                            </select>
                            @error('paiment')
                            <span class="text-danger">{{ $message }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                </svg>
                              </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <legend>Devise
                            <small class="text-danger">*</small>
                        </legend>
                        <div class="col-md-12">
                            <input type="radio" id="devise" name="devise" value="CAD" {{ old('devise') == 'CAD' ? 'checked' : '' }}> CAD - Dollar canadien
                        </div>
                        <div class="col-md-12">
                            <input type="radio" id="devise" name="devise" value="USD" {{ old('devise') == 'USD' ? 'checked' : '' }}> USD - Dollar des États-Unis
                        </div>
                        @error('devise')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                            </svg>
                          </span>
                        @enderror                        
                    </div>

                    <div class="row">
                        <legend>Mode de communication
                            <small class="text-danger">*</small>
                        </legend>
                        <div class="col-md-4"> 
                            <input type="radio" id="communication" name="communication" value="courriel" {{ old('communication') == 'courriel' ? 'checked' : '' }}> Courriel
                        </div>
                        <div class="col-md-6">
                            <input type="radio" id="communication" name="communication" value="courrier régulier" {{ old('communication') == 'courrier régulier' ? 'checked' : '' }}> Courrier régulier
                        </div>
                        @error('communication')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                              <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                            </svg>
                          </span>
                        @enderror                
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
    </div>
</div>
<script src="{{ asset('js/finances.js') }}"></script>
@endsection
