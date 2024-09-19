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
                <form action="{{ route('admin.ajoutContact') }}" method="post" id="form1">
                    @csrf

                    <h2 class="text-center" id="numContact1">Contact 1</h2>
                    <div class=" py-3">
                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" class="form-control" placeholder="Prénom" name="prenom" required
                                    value="{{-- {{ old('prenom') }} --}}a" id="prenom1">
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" class="form-control" placeholder="Nom" name="nom" required
                                    value="{{-- {{ old('nom') }} --}}a" id="nom1">
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Fonction</label>
                                <input type="text" class="form-control" placeholder="Fonction" name="fonction" required
                                    value="{{-- {{ old('fonction') }} --}}a" id="fonction1">
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Courriel</label>
                                <input type="email" class="form-control" placeholder="Courriel" name="courriel" required
                                    value="{{-- {{ old('courriel') }} --}}a@a" id="courriel1">
                            </div>
                        </div>




                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label for="typeTelephone" class="titreForm">Type</label>
                                <select class="form-control" id="typeTelephone1" name="typeTelephone">
                                    <option value="Bureau">Bureau</option>
                                    <option value="Telecopieur">Télécopieur</option>
                                    <option value="Cellulaire">Cellulaire</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Telephone</label>
                                <input type="text" class="form-control telephones" placeholder="Téléphone"
                                    name="telephone" required value="{{-- {{ old('telephone') }} --}}111-111-1111" id="telephone1">
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label>Poste</label>
                                <input type="tel" class="form-control" placeholder="Poste" name="poste"
                                    value="{{-- {{ old('poste') }} --}}" id="poste1">
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
