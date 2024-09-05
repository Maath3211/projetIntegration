<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PortailFournisseurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResponsablesController;


# Connexion portail fournisseur
Route::GET('/',
[PortailFournisseurController::class,'index'])->name('fournisseur.index');
Route::POST('/connexion/neq',
[PortailFournisseurController::class,'loginNeq'])->name('login.neq');
Route::POST('/connexion/email',
[PortailFournisseurController::class,'loginEmail'])->name('login.email');

# Information du fournisseur TODO: quand fournisseur sera completé
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('fournisseur.information');

# InscriptionIdentification
Route::GET('/compte/identification',
[PortailFournisseurController::class,'createIden'])->name('fournisseur.inscription');

Route::POST('/compte/identification',
[PortailFournisseurController::class,'storeIden'])->name('fournisseur.inscription');

# InscriptionUNSPSC
// Route::GET('/UNSPSC',
// [PortailFournisseurController::class,'UNSPSC'])->name('fournisseur.UNSPSC');

Route::GET('/UNSPSC',
[PortailFournisseurController::class,'createUnspsc'])->name('fournisseur.createUnspsc');

# admin
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting');

# Acccueil Responsable
Route::GET('/responsable',
[ResponsablesController::class,'index'])->name('responsable.index');
