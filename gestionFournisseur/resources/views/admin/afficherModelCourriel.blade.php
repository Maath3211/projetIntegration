@extends('layouts.layoutAdmin')
@section('title', 'Administration')

@section('contenu')
    <link rel="stylesheet" href="{{ asset('css/modelCourriel.css') }}">



    <form action="{{route('responsable.sauvegarderModelCourriel')}}" method="post">
        @csrf
        <label for="model" class="titreForm">Modèle
            <small class="text-danger"></small>
        </label>

        <select id="templateSelect" class="form-control" name="model_courriel">
            @foreach ($modelCourriels as $modelCourriel)
                <option value="{{ $modelCourriel->id }}">{{ $modelCourriel->nom }}</option>
            @endforeach
        </select>

        <div id="templateContent">
            <label for="sujet">Sujet</label>
            <textarea name="sujet" id="sujet" cols="50" rows="1"></textarea>
        </div>
        <div id="templateContent">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" cols="50" rows="10"></textarea>
        </div>



        <button type="submit" class="btn btn-success" id="btAccepter">Sauvegarder</button>
    </form>










    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            function chargerContenu() {
                var selectedModelId = $('#templateSelect').val(); // Get the selected value

                $.ajax({
                    url: '/get-template-content',
                    method: 'GET',
                    data: {
                        modelId: selectedModelId
                    },
                    success: function(response) {
                        $('#sujet').text(response.sujet);
                        $('#contenu').text(response.contenu);
                    },
                    error: function(xhr) {
                        console.log('Error loading template:', xhr.responseText);
                    }
                });
            }

            $('#templateSelect').change(function() {
                chargerContenu();
            });

            chargerContenu();
        });
    </script>







    <a href="{{ route('responsable.demandeFournisseur') }}">modele de courriel</a>
    {{-- <script src="{{ asset('js/modelCourriel.js') }}"></script> --}}
@endsection