@extends('layouts.fournisseur')
@section('title',"Page d'accueil")
<header>
<div>
    <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>

</div>
</header>
@section('contenu')

<div class="container-fluid">
    <div class="row">


        <div class="col-md-2">

        </div>


    <div class="col-md-8 ">

        <fieldset>
          <legend>Licence RBQ</legend>

          <div class="row">
            <div class="col-md-6">
                <h5>Numéro de licence RBQ</h5>
            </div>

            <div class="col-md-6">
                <h5>Statut</h5>
            </div>



            <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" maxlength="12" id="search-input" name="recherche" placeholder="####-####-##">
            </div>

                <div class="col-md-6">
                    <select class="form-control">
                        <option value="1">Valid</option>
                        <option value="2">Valide avec restriction</option>
                        <option value="3">Non valide</option>
                    </select>
                </div>

        </div>


            <div class="row mt-5">
                <div class="col-md-5">
                    <h5>Type de licence</h5>
                </div>

                <div class="col-md-7">
                    <select class="form-control">
                        <option value="1">Entrepreneur</option>
                        <option value="2">Constructeur-Propriétaire</option>
                    </select>
                </div>


            </div>


            <div class="row">
                <h5 class="pl-5">Catégorie et sous-catégories autorisées</h5>

                <form method="POST" >

                     @csrf
                @if (count($data)) 
                <div class="scroll-container">
                     @foreach($data as $record) 

                        <div class="item">
                            <div class="col-md-1">
                                <input type="radio" class="mt-2" id="idUnspsc" name="idUnspsc">
                            </div>
                    
                            <div class="col-md-4">
                                <p>{{ $record['Sous-categories'] }}</p>
                            </div>
            
                            <div class="col-md-7">
                                <p>{{ $record['Categorie'] }}</p>
                            </div>
                        </div>
                     @endforeach 
                </div>
             @else
                <p>Erreur : aucun Services public proposé</p>
            @endif 



            <div class="row mt-4">

                <div class="col-md-3">
                    <button class="form-control">Précédent</button>
                </div>

                <div class="col-md-6">
                </div>

                <div class="col-md-3">
                <button class="btn btn-default" >Suivant</button>
            </form>
                </div>
            </div>

        </fieldset>

    </div>










    <div class="col-md-2">
            
    </div>


    </div>
</div>


<script src="{{ asset('js/RBQ.js') }}"></script>

@endsection