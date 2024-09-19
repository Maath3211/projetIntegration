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
                <legend>Finances</legend>
                <form method="POST" action="{{ route('fournisseur.storeFinances') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Numéro de TPS</h5>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="tps" name="tps" value="{{old('tps')}}">
                        </div>

                        <div class="col-md-6">
                            <h5>Numéro de TVQ</h5>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="tvq" name="tvq" value="{{old('tvq')}}">
                        </div>

                        <div class="col-md-6">
                            <h5>Conditions de paiement</h5>
                        </div>
                        <div class="col-md-12">
                            <select class="form-control" name="paiement" id="paiement" value="{{old('paiement')}}">
                                <option value="Payable immédiatement sans déduction" {{ old('paiement') == 'Payable immédiatement sans déduction' ? 'selected' : '' }}>Payable immédiatement sans déduction</option>
                                <option value="Payable immédiatement sans déduction. Date de base au 15 du mois suivant" {{ old('paiement') == 'Payable immédiatement sans déduction. Date de base au 15 du mois suivant' ? 'selected' : '' }}>Payable immédiatement sans déduction. Date de base au 15 du mois suivant</option>
                                <option value="Dans les 15 jours 2% escompte. dans les 30 jours sans déduction" {{ old('paiement') == 'Dans les 15 jours 2% escompte. dans les 30 jours sans déduction' ? 'selected' : '' }}>Dans les 15 jours 2% escompte, dans les 30 jours sans déduction</option>
                                <option value="Après entrée facture jusqu'au 15 du mois. jusqu'au 15 du mois suivant" {{ old('paiement') == 'Après entrée facture jusqu\'au 15 du mois. jusqu\'au 15 du mois suivant' ? 'selected' : '' }}>Après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant</option>
                                <option value="Dans les 15 jours sans déduction" {{ old('paiement') == 'Dans les 15 jours sans déduction' ? 'selected' : '' }}>Dans les 15 jours sans déduction</option>
                                <option value="Dans les 30 jours sans déduction" {{ old('paiement') == 'Dans les 30 jours sans déduction' ? 'selected' : '' }}>Dans les 30 jours sans déduction</option>
                                <option value="Dans les 45 jours sans déduction" {{ old('paiement') == 'Dans les 45 jours sans déduction' ? 'selected' : '' }}>Dans les 45 jours sans déduction</option>
                                <option value="Dans les 60 jours sans déduction" {{ old('paiement') == 'Dans les 60 jours sans déduction' ? 'selected' : '' }}>Dans les 60 jours sans déduction</option>
                            
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <legend>Devise</legend>
                        <div class="col-md-12">
                            <input type="radio" id="devise" name="devise" value="CAD" {{ old('devise') == 'CAD' ? 'checked' : '' }}> CAD - Dollar canadien
                        </div>
                        <div class="col-md-12">
                            <input type="radio" id="devise" name="devise" value="USD" {{ old('devise') == 'USD' ? 'checked' : '' }}> USD - Dollar des États-Unis
                        </div>                        
                    </div>

                    <div class="row">
                        <legend>Mode de communication</legend>
                        <div class="col-md-4"> 
                            <input type="radio" id="communication" name="communication" value="courriel" {{ old('communication') == 'courriel' ? 'checked' : '' }}> Courriel
                        </div>
                        <div class="col-md-6">
                            <input type="radio" id="communication" name="communication" value="courrielRegulier" {{ old('communication') == 'courrielRegulier' ? 'checked' : '' }}> Courriel régulier
                        </div>                        
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
    </div>
</div>
@endsection
