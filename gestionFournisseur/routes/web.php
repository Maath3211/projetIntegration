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

# Inscription
Route::GET('/compte',
[PortailFournisseursController::class,'create'])->name('fournisseur.inscription');

Route::POST('/compte',
[PortailFournisseursController::class,'store'])->name('fournisseur.inscription');

# Accceuil admin
Route::GET('/administration',
[AdminController::class,'index'])->name('admin.index');

# Accceuil Responsable
Route::GET('/responsable',
[ResponsablesController::class,'index'])->name('responsable.index');
