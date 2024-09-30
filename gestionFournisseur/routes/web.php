<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PortailFournisseurController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\ResponsablesController;

#FOURNISSEUR

# Connexion 
Route::GET('/',
[PortailFournisseurController::class,'index'])->name('fournisseur.index');

Route::POST('/connexion/neq',
[PortailFournisseurController::class,'loginNeq'])->name('login.neq');

Route::POST('/connexion/email',
[PortailFournisseurController::class,'loginEmail'])->name('login.email');

# Reinitialisation mot de passe
Route::GET('/reinitialisation',
[AdminController::class, 'sendResetPasswordView'])->name('login.resetView');

Route::POST('/reinitialisation',
[AdminController::class, 'sendResetPassword']) -> name('login.reset');

Route::GET('/reinitialisation/{code}',
[AdminController::class, 'resetPasswordView'])->name('login.modifierView');

Route::POST('/reinitialisation/{code}',
[AdminController::class, 'resetPassword']) -> name('login.modifier');



#Déconnexion
Route::POST('/logout',
[PortailFournisseurController::class,'logout'])->name('fournisseur.logout');

# InscriptionIdentification
Route::GET('/identification',
[PortailFournisseurController::class,'createIdentification'])->name('fournisseur.identification');

Route::POST('/identification/store',
[PortailFournisseurController::class,'storeIdentification'])->name('fournisseur.storeIdentification');

# InscriptionUNSPSC
Route::GET('/UNSPSC',
[PortailFournisseurController::class,'UNSPSC'])->name('fournisseur.UNSPSC');

Route::POST('/UNSPSC/store',
[PortailFournisseurController::class,'storeUnspsc'])->name('fournisseur.storeUnspsc');

# InscriptionRBQ
Route::GET('/RBQ/{id}',
[PortailFournisseurController::class,'RBQ'])->name('fournisseur.RBQ');

Route::POST('/RBQ/store',
[PortailFournisseurController::class,'storeRBQ'])->name('fournisseur.storeRBQ');

# InscriptionCoordonnées
Route::GET('/coordonnees',
[PortailFournisseurController::class,'createCoordo'])->name('fournisseur.coordonnees');

Route::POST('/coordonnees/store',
[PortailFournisseurController::class,'storeCoordo'])->name('fournisseur.storeCoordonnees');

# InscriptionContact
Route::GET('/contact',
[PortailFournisseurController::class,'contact'])->name('fournisseur.contact');

Route::POST('/contact/store',
[PortailFournisseurController::class,'storeContact'])->name('fournisseur.storeContact');

# InscriptionImportation 
Route::GET('/importation',
[PortailFournisseurController::class,'importation'])->name('fournisseur.importation');

Route::PATCH('/importation/store',
[PortailFournisseurController::class,'storeImportation'])->name('fournisseur.storeImportation');

# InscriptionFinance
Route::GET('/finances',
[PortailFournisseurController::class,'finances'])->name('fournisseur.finances');

Route::POST('/finances/store',
[PortailFournisseurController::class,'storeFinances'])->name('fournisseur.storeFinances');

# Information du fournisseur TODO: quand fournisseur sera completé
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('fournisseur.information');




# ADMINISTRATION

# Settings
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting');




# RESPONSABLE

# Page principale
Route::GET('/responsable',
[AdminController::class,'index'])->name('responsable.index');

Route::GET('/responsable/listeFournisseur',
[AdminController::class,'listeFournisseur'])->name('responsable.listeFournisseur');







# TODO: A classer
Route::GET('/test',
[AdminController::class,'demandeFourn']);

Route::GET('/administration/demandeFournisseur',
[AdminController::class,'demandeFournisseurView'])->name('responsable.demandeFournisseur');

Route::GET('/administration/demandeFournisseur/{neq}',
[AdminController::class,'demandeFournisseurZoom'])->name('responsable.demandeFournisseurZoom');