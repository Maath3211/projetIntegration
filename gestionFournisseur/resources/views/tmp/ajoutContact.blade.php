@extends('layouts.fournisseur')

@section('title', 'Administration')

@section('contenu')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="text-center py-3">
                <div class="text-center py-5">
                    <h1>Inscription Fournisseur ( IDENTIFICATION )</h1>
                </div>

                <form action="{{ route('admin.ajoutContact') }}" method="post">
                    @csrf
                    <div class="d-flex">
                        <label>Prenom</label>
                        <input type="text" class="form-control" placeholder="Prenom" name="prenom" required
                            value="a">
                    </div>

                    <div class="d-flex">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Nom" name="nom" required
                            value="a">
                    </div>

                    <div class="d-flex">
                        <label>Fonction</label>
                        <input type="text" class="form-control" placeholder="Fonction" name="fonction" required
                            value="a">
                    </div>

                    <div class="d-flex">
                        <label>Courriel</label>
                        <input type="email" class="form-control" placeholder="Courriel" name="courriel" required
                            value="a@a">
                    </div>





                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label for="typeTel" class="titreForm">Type</label>
                            <select name="typeTel" class="form-control" id="typeTel" name="typeTel">
                                <option value="Bureau">Bureau</option>
                                <option value="Télécopieur">Télécopieur</option>
                                <option value="Cellulaire">Cellulaire</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex row justify-content-center">
                        <div class="form-group">
                            <label>Telephone</label>
                                <input type="text" class="form-control telephones" placeholder="Telephone"
                                    name="telephone" required value="666-666-6666">
                        </div>
                    </div>

                    <div class="d-flex">
                        <label>Poste</label>
                        <input type="tel" class="form-control" placeholder="Poste" name="poste" value="2089">
                    </div>


                    <br>
                    <div>
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/numTelephone.js') }}"></script>
@endsection