<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PortailFournisseurController;
use App\Http\Controllers\AdminController;


# Connexion portail fournisseur
Route::GET('/',
[PortailFournisseurController::class,'index'])->name('gestion.index');
Route::POST('/connexion/neq',
[PortailFournisseurController::class,'loginNeq'])->name('login.neq');
Route::POST('/connexion/email',
[PortailFournisseurController::class,'loginEmail'])->name('login.email');

# Information du fournisseur TODO: quand fournisseur sera completé
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('gestion.information');

# Inscription
Route::GET('/compte',
[PortailFournisseursController::class,'create'])->name('gestion.inscription');

Route::POST('/compte',
[PortailFournisseursController::class,'store'])->name('gestion.inscription');

# Accceuil admin
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting');
