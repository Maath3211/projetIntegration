@extends('layouts.fournisseur')

@section('title', 'Réinitialisation')


<div class="container-fluid">
    <div class="row">

        <div class="text-center">
            <h1>Réinitialisation mot de passe</h1>
        </div>



        @section('contenu')
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 offset-3">
                        <form action="{{ route('login.reset') }}" method="post">
                            @csrf

                            <div class=" py-5">
                                <div class="d-flex row justify-content-center">
                                    <div class="form-group">
                                        <label class="titreForm" for="identifiant">Adresse courriel ou NEQ</label>
                                        <input type="text" class="form-control" name="identifiant"
                                            placeholder="Courriel ou NEQ" required
                                            value="mathys.lessard.02@edu.cegeptr.qc.ca">
                                    </div>
                                </div>
                                <div class="d-flex row justify-content-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary">Réinitisaliser</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection
