@extends('layouts.fournisseur')
@section('title',"Page d'accueil")
<header>
<div>
    <a href="/"><h5 class="compagny">LOGO-VILLE3R</h5></a>

</div>
</header>

<div class="container-fluid">
    <div class="row">


        <div class="col-md-2">

        </div>


    <div class="col-md-8 ">

        <fieldset>
          <legend>Produits et services offerts</legend>

            <div class="row">
                <div class="col-md-7">
                    <h1>Services</h1>
                </div>

                <div class="col-md-4">
                    <input type="text" class="form-control" maxlength="80" id="search-input" name="recherche" placeholder="Rechercher...">
                </div>

                {{-- <div class="col-md-2 mt-1">
                    <Button>Logo</Button>
                </div> --}}
            </div>


            <div class="row">
                <h5 class="pl-5">S14 - Services Publics</h5>


                @if (count($codes))
                <div class="scroll-container">
                    @foreach($codes as $code)
                        <div class="item">
                            <div class="col-md-1">
                                <input type="radio" class="mt-2" id="{{ $code->id }}" name="choix" value="{{ $code->id }}">
                            </div>
                    
                            <div class="col-md-4">
                                <p>{{ $code->code }}</p>
                            </div>
            
                            <div class="col-md-7">
                                <p>{{ $code->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Erreur : aucun Services public proposé</p>
            @endif


            <div class="row">
                <h5 class="pl-5">Détails et spécifications</h5>


                <div class="col-md-1">
                    
                </div>

                <div class="col-md-10">
                    <textarea name="Details" id="detail" class="form-control" maxlength="500"></textarea>
                </div>

                <div class="col-md-1">
                    
                </div>
            </div>

            <div class="row mt-4">

                <div class="col-md-3">
                    <button class="form-control">Précédent</button>
                </div>

                <div class="col-md-6">
                </div>

                <div class="col-md-3">
                {{-- <button class="btn btn-default" href="{{ route(fournisseur.createUnspsc)}}">Suivant</button> --}}
                    
                </div>
            </div>

        </fieldset>

    </div>










    <div class="col-md-2">
            
    </div>


    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fuse.js@6.4.6/dist/fuse.basic.min.js"></script>
<script src="{{ asset('js/UnspscPage.js') }}"></script>