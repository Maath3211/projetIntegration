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

#Déconnexion
Route::POST('/logout',
[PortailFournisseurController::class,'logout'])->name('fournisseur.logout');

# Information du fournisseur TODO: quand fournisseur sera completé
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('fournisseur.information');

# InscriptionIdentification
Route::GET('/compte/identification',
[PortailFournisseurController::class,'createIden'])->name('fournisseur.inscription');

Route::POST('/compte/identification',
[PortailFournisseurController::class,'storeIden'])->name('fournisseur.inscription');

# InscriptionUNSPSC
Route::GET('/UNSPSC',
[PortailFournisseurController::class,'UNSPSC'])->name('fournisseur.UNSPSC');

Route::POST('/UNSPSC/store',
[PortailFournisseurController::class,'storeUnspsc'])->name('fournisseur.storeUnspsc');

# InscriptionRBQ
Route::GET('/RBQ',
[PortailFournisseurController::class,'RBQ'])->name('fournisseur.RBQ');

Route::POST('/RBQ/store',
[PortailFournisseurController::class,'storeRBQ'])->name('fournisseur.storeRBQ');

# InscriptionRBQ
Route::GET('/finances',
[PortailFournisseurController::class,'finances'])->name('fournisseur.finances');



# InscriptionCoordonnées
Route::GET('/compte/coordonnees',
[PortailFournisseurController::class,'createCoordo'])->name('fournisseur.coordonnees');

Route::POST('/compte/coordonnees',
[PortailFournisseurController::class,'storeCoordo'])->name('fournisseur.coordonnees');

# InscriptionImportaion 
Route::GET('/impo',
[AdminController::class,'impo'])->name('admin.impo');

Route::PATCH('/impoImg',
[AdminController::class,'impoImg'])->name('admin.impoImg');

# InscriptionContact
Route::GET('/Contact',
[AdminController::class,'contact'])->name('admin.contact');

Route::POST('/ajoutContactDB',
[AdminController::class,'Ajoutcontact'])->name('admin.ajoutContact');

# Accceuil admin
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting');

# Acccueil Responsable
Route::GET('/responsable',
[ResponsablesController::class,'index'])->name('responsable.index');

