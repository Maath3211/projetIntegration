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
Route::GET('/UNSPSC',
[PortailFournisseurController::class,'UNSPSC'])->name('fournisseur.UNSPSC');

# Information du fournisseur TODO: quand fournisseur sera completé
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('fournisseur.information');

# Inscription
Route::GET('/compte',
[PortailFournisseursController::class,'create'])->name('fournisseur.inscription');

Route::POST('/compte',
[PortailFournisseursController::class,'store'])->name('fournisseur.inscription');

# Accceuil Responsable
Route::GET('/responsable',
[ResponsablesController::class,'index'])->name('responsable.index');

# Accceuil admin
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting');
