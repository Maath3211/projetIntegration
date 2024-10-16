@extends('layouts.layoutAdmin')
@section('title', 'Administration')

@section('contenu')

    <label for="model" class="titreForm">Modèle
        <small class="text-danger"></small>
    </label>

    <select id="templateSelect" class="form-control" name="model_courriel">
        @foreach ($modelCourriels as $modelCourriel)
            <option value="{{ $modelCourriel->id }}">{{ $modelCourriel->nom }}</option>
            @endforeach
    </select>

    <div id="templateContent">

    </div>








    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#templateSelect').change(function() {
                var selectedModelId = $(this).val();

                $.ajax({
                    url: '/get-template-content',
                    method: 'GET',
                    data: {
                        modelId: selectedModelId
                    },
                    success: function(response) {
                        $('#templateContent').html(response.contenu);
                    },
                    error: function(xhr) {
                        console.log('Error loading template:', xhr.responseText);
                    }
                });
            });
        });
    </script>









    <a href="{{ route('responsable.demandeFournisseur') }}">modele de courriel</a>
    {{-- <script src="{{ asset('js/modelCourriel.js') }}"></script> --}}
@endsection
