@extends('layouts.layoutAdmin')
@section('title', 'Administration')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">



@section('contenu')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="text-center py-3">
                    <h1>Demande de fournisseur en attente</h1>


                    <table class="table table-hover table-striped">

                        <tr>
                            <th scope="col">Entreprise</th>
                            <th scope="col">Courriel</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>

                        
                            @foreach ($fnAttentes as $fn)
                            <tr>
                            <td>{{$fn->entreprise}}</td>
                            <td>{{$fn->email}}</td>
                            <td> <a href="{{ route('responsable.demandeFournisseurZoom', $fn->neq) }}" class="btn btn-info">Plus d'information</a> </td>
                            </tr>
                        @endforeach
                            
                      </table>



                </div>
            </div>
        </div>
    </div>
@endsection
