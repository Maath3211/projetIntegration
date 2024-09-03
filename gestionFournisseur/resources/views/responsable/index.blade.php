@extends('layouts.app')
@section('title',"Page d'accueil")

<!-- TODO: aller chercher les fournisseur dans la BD -->
<!-- FIXME: Le designe ces TURBO LAID !!!! -->
<header>
<div>
    <a href="/"><h5 class="compagny">VILLE3R</h5></a>
</div>
</header>
<div class="container bg-primary mb-3">
    <div class="row">
        <div class="col-8 text-end">

        </div>
        <div class="col-4">
            <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Entrez" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon2">Recherche</button>
                </div>
            </div>
        </div>


        <div class="col-12 bg-danger text-center p-5">
            <h1>Tri</h1>
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
