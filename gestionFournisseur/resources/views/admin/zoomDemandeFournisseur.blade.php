@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">



@section('contenu')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="text-center py-3">
                    <h1>{{ $fn->entreprise }}</h1>
                    <h3>{{ $fn->email }}</h3>
                    <h3>{{ $fn->statut }}</h3>
                    @if ($contacts)
                        @foreach ($contacts as $contact)
                            <h3>{{ $contact->prenom }}</h3>
                            <h3>{{ $contact->nom }}</h3>
                            <h3>{{ $contact->fonction }}</h3>
                            <h3>{{ $contact->courriel }}</h3>
                            <h3>{{ $contact->telephone }}</h3>
                            <h3>{{ $contact->typeTelephone }}</h3>
                            <h3>{{ $contact->poste }}</h3>
                        @endforeach

                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
