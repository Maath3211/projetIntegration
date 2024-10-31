<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PortailFournisseurController;
use App\Http\Controllers\AdminController;

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

Route::GET('/password/edit',
[PortailFournisseurController::class, 'editPassword'])->name('fournisseur.password.edit');

Route::POST('/password/update',
[PortailFournisseurController::class, 'updatePassword'])->name('fournisseur.password.update');

#Déconnexion
Route::POST('/logout',
[PortailFournisseurController::class,'logout'])->name('fournisseur.logout');

# InscriptionIdentification
Route::GET('/inscription',
[PortailFournisseurController::class,'inscription'])->name('fournisseur.inscription');

Route::POST('/inscription/store',
[PortailFournisseurController::class,'storeInscription'])->name('fournisseur.storeInscription');

Route::GET('/identification',
[PortailFournisseurController::class,'createIdentification'])->name('fournisseur.identification');

Route::POST('/identification/store',
[PortailFournisseurController::class,'storeIdentification'])->name('fournisseur.storeIdentification');

Route::GET('/identification/edit',
[PortailFournisseurController::class, 'editIdentification'])->name('fournisseur.identification.edit');

Route::POST('/identification/update',
[PortailFournisseurController::class, 'updateIdentification'])->name('fournisseur.identification.update');

# InscriptionCoordonnées
Route::GET('/coordonnees',
[PortailFournisseurController::class,'createCoordo'])->name('fournisseur.coordonnees');

Route::POST('/coordonnees/store',
[PortailFournisseurController::class,'storeCoordo'])->name('fournisseur.storeCoordonnees');

Route::GET('/coordonnees/edit',
[PortailFournisseurController::class, 'editCoordonnees'])->name('fournisseur.coordonnees.edit');

Route::POST('/coordonnees/update',
[PortailFournisseurController::class, 'updateCoordonnees'])->name('fournisseur.coordonnees.update');

# InscriptionContact
Route::GET('/contact',
[PortailFournisseurController::class,'contact'])->name('fournisseur.contact');

Route::POST('/contact/store',
[PortailFournisseurController::class,'storeContact'])->name('fournisseur.storeContact');

# InscriptionUNSPSC
Route::GET('/UNSPSC',
[PortailFournisseurController::class,'UNSPSC'])->name('fournisseur.UNSPSC');

Route::POST('/UNSPSC/store',
[PortailFournisseurController::class,'storeUnspsc'])->name('fournisseur.storeUnspsc');

Route::GET('/UNSPSC/{unspsc}/modifier',
[PortailFournisseurController::class,'editUnspsc'])->name('fournisseur.UNSPSC.edit');

Route::PATCH('/UNSPSC/{unspsc}/modifier',
[PortailFournisseurController::class,'updateUNSPSC'])->name('fournisseur.UNSPSC.update');

# InscriptionRBQ
Route::GET('/RBQ',
[PortailFournisseurController::class,'RBQ'])->name('fournisseur.RBQ');

Route::POST('/RBQ/store',
[PortailFournisseurController::class,'storeRBQ'])->name('fournisseur.storeRBQ');

Route::GET('/RBQ/{rbq}/modifier',
[PortailFournisseurController::class, 'editRBQ'])->name('fournisseur.RBQ.edit');

Route::PATCH('/RBQ/{rbq}/modifier',
[PortailFournisseurController::class, 'updateRBQ'])->name('fournisseur.RBQ.update');

# InscriptionImportation 
Route::GET('/importation',
[PortailFournisseurController::class,'importation'])->name('fournisseur.importation');

Route::PATCH('/importation/store',
[PortailFournisseurController::class,'storeImportation'])->name('fournisseur.storeImportation');

Route::delete('/file/{id}',
[PortailFournisseurController::class,'deleteFile'])->name('fournisseur.deleteFile');

# InscriptionFinance
Route::GET('/finances',
[PortailFournisseurController::class,'finances'])->name('fournisseur.finances');

Route::POST('/finances/store',
[PortailFournisseurController::class,'storeFinances'])->name('fournisseur.storeFinances');

Route::GET('/finances/edit',
[PortailFournisseurController::class, 'editFinances'])->name('fournisseur.finances.edit');

Route::POST('/finances/update',
[PortailFournisseurController::class, 'updateFinances'])->name('fournisseur.finances.update');





# Information du fournisseur
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('fournisseur.information');

# Retirer la fiche fournisseur
Route::POST('/information/desactive',
[PortailFournisseurController::class,'storeDesactive'])->name('fournisseur.storeDesactive');

# Activer la fiche fournisseur
Route::POST('/information/active',
[PortailFournisseurController::class,'storeActive'])->name('fournisseur.storeActive');




# ADMINISTRATION

# Settings
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting');




# RESPONSABLE

# Page acceuil connexion
Route::GET('/responsable',
[AdminController::class,'index'])->name('responsable.index');

Route::POST('/connexion/responsable/email',
[AdminController::class,'loginEmailResponsable'])->name('login.email.reponsable');

#Affichage TODO: a supprimer [
Route::GET('/affiche',
[AdminController::class,'affiche'])->name('responsable.affiche');
#                           ]

Route::GET('/responsable/listeFournisseur',
[AdminController::class,'listeFournisseur'])->name('responsable.listeFournisseur');

# Demande de fournisseur
Route::GET('/responsable/demandeFournisseur',
[AdminController::class,'demandeFournisseurView'])->name('responsable.demandeFournisseur');

Route::GET('/responsable/demandeFournisseur/{neq}',
[AdminController::class,'demandeFournisseurZoom'])->name('responsable.demandeFournisseurZoom');

Route::POST('/responsable/demandeFournisseur/{neq}/accepter',
[AdminController::class, 'accepterFournisseur'])->name('responsable.accepterFournisseur');

Route::POST('/responsable/demandeFournisseur/{neq}/refuser',
[AdminController::class, 'refuserFournisseur'])->name('responsable.refuserFournisseur');

Route::GET('/responsable/demandeFournisseur/{neq}/fichier/{idFichier}',
[AdminController::class, 'telechargerFichier'])->name('responsable.telechargerFichier');


# Modele de courriel

Route::GET('/responsable/modeleCourriel',
[AdminController::class, 'afficherModelCourriel'])->name('responsable.afficherModelCourriel');

Route::get('/get-template-content', [AdminController::class, 'getModel']);

Route::POST('/responsable/sauvegarderModeleCourriel',
[AdminController::class, 'sauvegarderModelCourriel'])->name('responsable.sauvegarderModelCourriel');



# TODO: Classer et ajuster quand déplacer dans le controller
Route::delete('/contact/supprimer/{id}',
[AdminController::class, 'deleteContact'])->name('fournisseur.deleteContact');

Route::GET('/contact/editContact/{id}',
[AdminController::class, 'editContact'])->name('fournisseur.editContact');

Route::POST('/contact/updateContact/{id}',
[AdminController::class, 'updateContact'])->name('fournisseur.updateContact');

Route::GET('/contact/addContactCreer/{id}',
[AdminController::class, 'addContactCreer'])->name('fournisseur.addContactCreer');

Route::POST('/contact/storeContactCreer/{id}',
[AdminController::class, 'storeContactCreer'])->name('fournisseur.storeContactCreer');



Route::get('/export-csv', [AdminController::class, 'exportCsv'])->name('export.csv');

