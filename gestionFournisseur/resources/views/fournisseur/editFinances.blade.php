@extends('layouts.fournisseur')
@section('title', "MOD Finances")
@section('contenu')
<div class="text-center">
    <h1>Mise à jour ( FINANCES )</h1>
</div>
<form method="POST" action="{{ route('fournisseur.finances.update', [$finances->fournisseur_id]) }}">
    @csrf
    <div class="container-fluid bordure">
        <fieldset class="border p-3">
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="prenom" class="titreForm">Numéro TPS
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" id="tps" name="tps" value="{{old('tps', $finances->tps)}}">
                    @error('tps')
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
                    <label for="prenom" class="titreForm">Numéro TVQ
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" id="tvq" name="tvq" value="{{old('tvq', $finances->tvq)}}">
                    @error('tvq')
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
                    <label for="prenom" class="titreForm">Condition de paiement
                        <small class="text-danger">*</small>
                    </label>
                    <select class="form-control" name="paiement" id="paiement">
                        <option value="Aucune option de paiement" {{ old('paiement', $finances->paiement ?? '', 'Aucune option de paiment') == 'Aucune option de paiment' ? 'selected' : '' }}>Aucune option de paiement</option>
                        <option value="Payable immédiatement sans déduction" {{ old('paiement', $finances->paiment ?? '') == 'Payable immédiatement sans déduction' ? 'selected' : '' }}>Payable immédiatement sans déduction</option>
                        <option value="Payable immédiatement sans déduction. Date de base au 15 du mois suivant" {{ old('paiement', $finances->paiement ?? '') == 'Payable immédiatement sans déduction. Date de base au 15 du mois suivant' ? 'selected' : '' }}>Payable immédiatement sans déduction. Date de base au 15 du mois suivant</option>
                        <option value="Dans les 15 jours 2% escompte. dans les 30 jours sans déduction" {{ old('paiement', $finances->paiement ?? '') == 'Dans les 15 jours 2% escompte. dans les 30 jours sans déduction' ? 'selected' : '' }}>Dans les 15 jours 2% escompte, dans les 30 jours sans déduction</option>
                        <option value="Après entrée facture jusqu'au 15 du mois. jusqu'au 15 du mois suivant" {{ old('paiement', $finances->paiement ?? '') == 'Après entrée facture jusqu\'au 15 du mois. jusqu\'au 15 du mois suivant' ? 'selected' : '' }}>Après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant</option>
                        <option value="Dans les 15 jours sans déduction" {{ old('paiement', $finances->paiement ?? '') == 'Dans les 15 jours sans déduction' ? 'selected' : '' }}>Dans les 15 jours sans déduction</option>
                        <option value="Dans les 30 jours sans déduction" {{ old('paiement', $finances->paiement ?? '') == 'Dans les 30 jours sans déduction' ? 'selected' : '' }}>Dans les 30 jours sans déduction</option>
                        <option value="Dans les 45 jours sans déduction" {{ old('paiement', $finances->paiement ?? '') == 'Dans les 45 jours sans déduction' ? 'selected' : '' }}>Dans les 45 jours sans déduction</option>
                        <option value="Dans les 60 jours sans déduction" {{ old('paiement', $finances->paiement ?? '') == 'Dans les 60 jours sans déduction' ? 'selected' : '' }}>Dans les 60 jours sans déduction</option>
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
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="devise" class="titreForm">Devise
                        <small class="text-danger">*</small>
                    </label>
                    <div class="col-md-6">
                        <input type="radio" id="devise" name="devise" value="CAD" {{ old('devise', $finances->devise ?? '') == 'CAD' ? 'checked' : '' }}> CAD - Dollar canadien
                    </div>
                    <div class="col-md-6">
                        <input type="radio" id="devise" name="devise" value="USD" {{ old('devise', $finances->devise ?? '') == 'USD' ? 'checked' : '' }}> USD - Dollar des États-Unis
                    </div>
                    @error('devise')
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
                    <label for="communication" class="titreForm">Mode de communication
                        <small class="text-danger">*</small>
                    </label>
                    <div class="col-md-6"> 
                        <input type="radio" id="communication" name="communication" value="courriel" {{ old('communication',$finances->communication ?? '') == 'courriel' ? 'checked' : '' }}> Courriel
                    </div>
                    <div class="col-md-6">
                        <input type="radio" id="communication" name="communication" value="courrier régulier" {{ old('communication',$finances->communication ?? '') == 'courrier régulier' ? 'checked' : '' }}> Courrier régulier
                    </div>
                    @error('communication')
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
                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                </div> 
            </div>
        </fieldset>
    </div>
</form>
@endsection
