@extends('layouts.fournisseur')

@section('title', 'Contact')


<div class="container-fluid">
    <div class="row">

        <div class="text-center">
            <h1>Ajouter un contact</h1>
        </div>



        @section('contenu')
            <p id="plus1">&#8853;</p>
            <div class="col-md-6 offset-3" id="form1Div">
                <form action="{{ route('fournisseur.storeContact') }}" method="post" id="form1">
                    @csrf

                    <h2 class="text-center" id="numContact1">Contact 1</h2>
                    <div class=" py-3">
                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Prénom
                                    <small class="text-danger">*</small>
                                </label>
                                <input type="text" class="form-control" placeholder="Prénom" name="prenom" required
                                    value="{{-- {{ old('prenom') }} --}}a" id="prenom1">
                                    @error('prenom')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Nom
                                    <small class="text-danger">*</small>
                                </label>
                                <input type="text" class="form-control" placeholder="Nom" name="nom" required
                                    value="{{-- {{ old('nom') }} --}}a" id="nom1">
                                    @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Fonction
                                    <small class="text-danger">*</small>
                                </label>
                                <input type="text" class="form-control" placeholder="Fonction" name="fonction" required
                                    value="{{-- {{ old('fonction') }} --}}a" id="fonction1">
                                    @error('fonction')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Courriel
                                    <small class="text-danger">*</small>
                                </label>
                                <input type="email" class="form-control" placeholder="Courriel" name="courriel" required
                                    value="{{-- {{ old('courriel') }} --}}a@a" id="courriel1">
                                    @error('courriel')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>




                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label for="typeTelephone" class="titreForm">Type
                                    <small class="text-danger">*</small>
                                </label>
                                <select class="form-control" id="typeTelephone1" name="typeTelephone">
                                    <option value="Bureau">Bureau</option>
                                    <option value="Telecopieur">Télécopieur</option>
                                    <option value="Cellulaire">Cellulaire</option>
                                </select>
                                @error('typeTelephone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label for="telephone" class="titreForm">Telephone
                                    <small class="text-danger">*</small>
                                </label>
                                <input type="text" class="form-control telephones" placeholder="Téléphone"
                                    name="telephone" required value="{{-- {{ old('telephone') }} --}}111-111-1111" id="telephone1">
                                    @error('telephone1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label for="poste" class="titreForm">Poste
                                    <small class="text-muted">(Optionel)</small>
                                </label>
                                <input type="tel" class="form-control" placeholder="Poste" name="poste"
                                    value="{{-- {{ old('poste') }} --}}" id="poste1">
                                    @error('poste')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
            </div>

            <br>

            </form>

            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <button onclick="submitForms()" class="btn btn-secondary">Sauvegarder</button>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/numTelephone.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
@endsection
