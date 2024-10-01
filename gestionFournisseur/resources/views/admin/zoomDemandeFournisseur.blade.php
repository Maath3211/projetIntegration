@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/zoomDemandeFournisseur.css') }}">
@section('contenu')
    <div id="container">
        <a href="{{ route('responsable.demandeFournisseur') }}" class="btn btn-info">Retour</a>


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
            <p>Création le {{ $fn->created_at }}</p>
            <p>Dernière modification le {{ $fn->updated_at }}</p>
        </div>

        <div>
            <h3>Identification</h3>
            <p>NEQ: {{ $fn->neq }}</p>
            <p>{{ $fn->entreprise }}</p>
            <p>{{ $fn->email }}</p>
        </div>


        <div>
            <h3>Adresse</h3>
            <p>{{ $coord->noCivic . ', ' . $coord->rue }}</p>
            <p>{{ $coord->ville . ' (' . $coord->province . ') ' . $coord->codePostal }}</p>
            <p><a href="https://{{ $coord->site }} " target='blank'>{{ $coord->site }}</a></p>
            <p>{{ $coord->typeTel . ' ' . $coord->numero }}</p>
            @if ($coord->typeTel2 && $coord->numero2)
                <p>{{ $coord->typeTel2 . ' ' . $coord->numero2 }}</p>
            @endif
        </div>

        <div>
            <h3>Pièces jointes</h3>
        </div>


        @foreach ($files as $file)
            <?php $extension = pathinfo($file->nomFichier, PATHINFO_EXTENSION); ?>
            @if ($extension == 'png')
                <img src="{{ asset('images/icons/png.png') }}" class="imgFormat">
            @elseif($extension == 'pdf')
                <img src="{{ asset('images/icons/pdf.png') }}" class="imgFormat">
            @elseif($extension == 'jpg' || $extension == 'jpeg')
                <img src="{{ asset('images/icons/jpg.png') }}" class="imgFormat">
            @elseif($extension == 'txt' || $extension == 'doc' || $extension == 'docx')
                <img src="{{ asset('images/icons/txt.png') }}" class="imgFormat">
            @elseif($extension == 'xls' || $extension == 'xlsx' || $extension == 'csv')
                <img src="{{ asset('images/icons/xls.png') }}" class="imgFormat">
            @endif
            <a href="{{ route('responsable.telechargerFichier', [$fn->neq, $file->id]) }}"> {{ $file->nomFichier }},
                {{ $file->tailleFichier_KO }} ko</a>
            <br>
        @endforeach

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
                        <td>{{ $contact->telephone }} {{ $contact->poste ? '#' . $contact->poste : 'Aucun' }}
                        </td>
                    @endforeach
                @endif
            </tr>
        </table>

        <form action="{{ route('responsable.accepterFournisseur', $fn->neq) }}" method="post" id="form1">
            @csrf
            <button type="submit" class="btn btn-success">Accepter</button>
        </form>
        <form action="{{ route('fournisseur.storeContact') }}" method="post" id="form1">
            @csrf
            <button type="submit" class="btn btn-danger">Refuser</button>
        </form>

    </div>
@endsection
