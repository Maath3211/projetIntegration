@extends('layouts.fournisseur')
@section('title',"Page d'accueil")

<!-- TODO: aller chercher les fournisseur dans la BD -->
<!-- FIXME: Le designe ces TURBO LAID !!!! -->
<!-- FIXME: Les dropdown ne fonctionnent pas  -->
<header>
<div>
    <a href="/"><h5 class="compagny">VILLE3R</h5></a>
</div>
</header>
<div class="container bg-primary mb-3">
    <div class="row">
        <div class="col-2 mt-3 mb-3">
            
            <input type="checkbox">
            <p>En attente</p>
        </div>

        <div class="col-2 mt-3 mb-3 append">
            <input type="checkbox">
            <p>Acceptées</p>
        </div>

        <div class="col-2 mt-3 mb-3 append">
            <input type="checkbox">
            <p>Refusées</p>
        </div>

        <div class="col-2 mt-3 mb-3 ">
            <input type="checkbox">
            <p>À réviser</p>
        </div>


        <div class="col-4">
            <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Entrez" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon2">Recherche</button>
                </div>
            </div>
        </div>

<!-- Triage -->
        <div class="col-3 bg-danger text-center pt-5 pb-5  border ">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Produit et service" >
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> . </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 bg-danger text-center pt-5 border">
        <div class="input-group">
                <input type="text" class="form-control" placeholder="Catégories de travaux" >
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><</button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 bg-danger text-center pt-5 border">
        <div class="input-group">
                <input type="text" class="form-control" placeholder="Régions administratives" >
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><</button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 bg-danger text-center pt-5 border">
        <div class="input-group">
                <input type="text" class="form-control" placeholder="Régions administratives" >
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><</button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>

               






    </div>
</div>

<div class="container bg-primary">
    <div class="row ">
        <div class="col-8 text-end mt-3 mb-3">
            
        </div>
        <div class="col-2 text-end mt-3 mb-3">
            
            <button class="btn btn-danger form-control">Exporter</button>
        </div>
        <div class="col-2 text-end mt-3 mb-3">
            
            <button class="btn btn-danger form-control">Zoom Fournisseur</button>
        </div>


        <div class="row">

        <h1>YUUUUP</h1>

        </div>
            <!-- <div class="col-1 bg-danger ">
            <h1>Tri</h1>
        </div>

        <div class="col-10 bg-warning text-center">
            <h1>Tri</h1>
        </div>

        <div class="col-1 bg-danger ">
            <h1>Tri</h1>
        </div> -->

    </div>
</div>
