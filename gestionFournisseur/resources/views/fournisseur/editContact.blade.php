@extends('layouts.fournisseur')
@section('title',"MOD Contacts")

@section('contenu')
<div class="text-center">
    <h1>Mise à jour ( CONTACT )</h1>
</div>
<form action="{{ route('fournisseur.updateContact', $contact->id) }}" method="POST" id="form1">
    @csrf
    <div class="container-fluid bordure">
        <fieldset class="border p-3">
            <legend>Contact</legend>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label>Prénom
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" placeholder="Prénom" name="prenom" required
                        value="{{ $contact->prenom }}" id="prenom1">
                    @error('prenom')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label>Nom
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" placeholder="Nom" name="nom" required
                        value="{{ $contact->nom }}" id="nom1">
                    @error('nom')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label>Fonction
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control" placeholder="Fonction" name="fonction" required
                        value="{{ $contact->fonction }}" id="fonction1">
                    @error('fonction')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label>Courriel
                        <small class="text-danger">*</small>
                    </label>
                    <input type="email" class="form-control" placeholder="Courriel" name="courriel" required
                        value="{{ $contact->courriel }}" id="courriel1">
                    @error('courriel')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="typeTelephone" class="titreForm">Type
                        <small class="text-danger">*</small>
                    </label>
                    <select class="form-control" id="typeTelephone1" name="typeTelephone">
                        <option value="Bureau" @if ($contact->typeTelephone == 'bureau') selected @endif>Bureau</option>
                        <option value="Telecopieur" @if ($contact->typeTelephone == 'Telecopieur') selected @endif>
                            Télécopieur</option>
                        <option value="Cellulaire" @if ($contact->typeTelephone == 'Cellulaire') selected @endif>Cellulaire
                        </option>
                    </select>
                    @error('typeTelephone')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="telephone" class="titreForm">Telephone
                        <small class="text-danger">*</small>
                    </label>
                    <input type="text" class="form-control telephones" placeholder="Téléphone"
                        name="telephone" required value="{{ $contact->telephone }}" id="telephone1">
                    @error('telephone1')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                            </svg>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="poste" class="titreForm">Poste
                        <small class="text-muted">(Optionnel)</small>
                    </label>
                    <input type="tel" class="form-control" placeholder="Poste" name="poste"
                        value="{{ $contact->poste }}" id="poste1">
                    @error('poste')
                        <span class="text-danger">{{ $message }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
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
    <script src="{{ asset('js/numTelephone.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
@endsection
