@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@section('contenu')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <a href="{{ route('responsable.demandeFournisseur') }}" class="btn btn-info">Retour</a>
                <div class="text-center py-3">
                    <h1>{{ $fn->entreprise }}</h1>
                    <div>
                        <h3>Statut</h3>
                        @if ($fn->statut == 'attente')
                            En attente
                        @elseif($fn->statut == 'confirme')
                            Acceptée le {{ $fn->dateStatut }}
                        @elseif($fn->statut == 'confirme')
                            Refusé le {{ $fn->dateStatut }}
                        @endif
                        <p>Création le {{$fn->created_at}}</p>
                        <p>Dernière modification le {{$fn->updated_at}}</p>
                    </div>

                    <div>
                        <h3>Identification</h3>
                        <p>NEQ: {{$fn->neq}}</p>
                        <p>{{ $fn->entreprise }}</p>
                        <p>{{ $fn->email }}</p>
                    </div>


                    <div>
                        <h3>Adresse</h3>
                        <p>{{ $coord->noCivic . ', ' . $coord->rue }}</p>
                        <p>{{ $coord->ville . ' (' . $coord->province . ') ' . $coord->codePostal }}</p>
                        <p>{{ $coord->site }}</p>
                        <p>{{ $coord->typeTel . ' ' . $coord->numero}}</p>
                        @if($coord->typeTel2 && $coord->numero2) <p>{{ $coord->typeTel2 . ' ' . $coord->numero2}}</p> @endif
                    </div>







                    <table class="table table-hover table-striped table-bordered">
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Fonction</th>
                            <th>Courriel</th>
                            <th>Type de téléphone</th>
                            <th>Téléphone</th>
                        </tr>
                        <tr>
                            @if ($contacts)
                                @foreach ($contacts as $contact)
                                    <td>{{ $contact->prenom }}</td>
                                    <td>{{ $contact->nom }}</td>
                                    <td>{{ $contact->fonction }}</td>
                                    <td>{{ $contact->courriel }}</td>
                                    <td>{{ $contact->typeTelephone }}</td>
                                    <td>{{ $contact->telephone }} {{ $contact->poste ? '#' . $contact->poste : 'Aucun' }}</td>
                                @endforeach
                            @endif
                        </tr>
                    </table>

                    <button type="submit" class="btn btn-success">Accepter</button>
                    <button type="submit" class="btn btn-danger">Refuser</button>

                </div>
            </div>
        </div>
    </div>
@endsection
