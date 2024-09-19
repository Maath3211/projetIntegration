@extends('layouts.fournisseur')

@section('title', 'Réinitialisation')
@section('contenu')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6 offset-3">
                <form action="{{ route('login.modifier', $codeReset) }}" method="post">
                    @csrf

                    <div class=" py-5">
                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label class="titreForm" for="password">Nouveau mot de passe</label>
                                <input type="Password" class="form-control" name="password" placeholder="Nouveau mot de passe"
                                    required>
                            </div>
                        </div>

                        <div class="d-flex row justify-content-center">
                            <div class="form-group">
                                <label class="titreForm" for="password_confirmation">Confirmation du nouveau mot de passe</label>
                                <input type="Password" class="form-control" name="password_confirmation" placeholder="Confirmation du nouveau mot de passe"
                                    required>
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

@endsection
