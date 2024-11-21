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
[AdminController::class, 'sendResetPassword'])->name('login.reset');

Route::GET('/reinitialisation/{code}',
[AdminController::class, 'resetPasswordView'])->name('login.modifierView');

Route::POST('/reinitialisation/{code}',
[AdminController::class, 'resetPassword'])->name('login.modifier');

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

Route::GET('/identification/{id}/edit',
[PortailFournisseurController::class, 'editIdentification'])->name('fournisseur.identification.edit');

Route::POST('/identification/{id}/update',
[PortailFournisseurController::class, 'updateIdentification'])->name('fournisseur.identification.update');

# InscriptionCoordonnées
Route::GET('/coordonnees',
[PortailFournisseurController::class,'createCoordo'])->name('fournisseur.coordonnees');

Route::POST('/coordonnees/store',
[PortailFournisseurController::class,'storeCoordo'])->name('fournisseur.storeCoordonnees');

Route::GET('/coordonnees/{id}/edit',
[PortailFournisseurController::class, 'editCoordonnees'])->name('fournisseur.coordonnees.edit');

Route::POST('/coordonnees/{id}/update',
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

Route::GET('/importation/edit/{id}',
[PortailFournisseurController::class, 'editImportation'])->name('fournisseur.importation.edit');

Route::PATCH('/importation/update/{id}',
[PortailFournisseurController::class, 'updateImportation'])->name('fournisseur.importation.update');

Route::delete('/file/{id}',
[PortailFournisseurController::class,'deleteFile'])->name('fournisseur.deleteFile');

# InscriptionFinance
Route::GET('/finances',
[PortailFournisseurController::class,'finances'])->name('fournisseur.finances');

Route::POST('/finances/store',
[PortailFournisseurController::class,'storeFinances'])->name('fournisseur.storeFinances');

Route::GET('/finances/edit/{id}',
[PortailFournisseurController::class,'editFinances'])->name('fournisseur.finances.edit');

Route::POST('/finances/update/{id}',
[PortailFournisseurController::class,'updateFinances'])->name('fournisseur.finances.update');





# Information du fournisseur
Route::GET('/information',
[PortailFournisseurController::class,'infoLogin'])->name('fournisseur.information');

# Retirer la fiche fournisseur
Route::POST('/information/desactive',
[PortailFournisseurController::class,'storeDesactive'])->name('fournisseur.storeDesactive');

# Activer la fiche fournisseur
Route::POST('/information/active',
[PortailFournisseurController::class,'storeActive'])->name('fournisseur.storeActive');

#Contact page informations
Route::delete('/contact/supprimer/{id}',
[PortailFournisseurController::class, 'deleteContact'])->name('fournisseur.deleteContact');

Route::GET('/contact/editContact/{id}',
[PortailFournisseurController::class, 'editContact'])->name('fournisseur.editContact');

Route::POST('/contact/updateContact/{id}',
[PortailFournisseurController::class, 'updateContact'])->name('fournisseur.updateContact');

Route::GET('/contact/addContact/{id}',
[PortailFournisseurController::class, 'addContactCreer'])->name('fournisseur.addContactCreer');

Route::POST('/contact/storeContactCreer/{id}',
[PortailFournisseurController::class, 'storeContactCreer'])->name('fournisseur.storeContactCreer');



# ADMINISTRATION

# Settings
Route::GET('/administration/parametre',
[AdminController::class,'setting'])->name('admin.setting')->middleware('check.role:Administrateur');

Route::POST('/administration/parametre/sauvegarde',
[AdminController::class,'update'])->name('admin.saveSetting')->middleware('check.role:Administrateur');




# RESPONSABLE / ADMIN / COMMIS

# Page acceuil connexion
Route::GET('/responsable',
[AdminController::class,'index'])->name('responsable.index');

Route::POST('/connexion/responsable/email',
[AdminController::class,'loginEmailResponsable'])->name('login.email.responsable');

# Logout
Route::POST('/admin/logout',
[AdminController::class,'logout'])->name('admin.logout');

# Gestion des roles

Route::GET('/administration/gerer',
[AdminController::class,'gererResponsable'])->name('responsable.gererResponsable')->middleware('check.role:Administrateur');

Route::POST('/administration/gerer/edit/{id}',
[AdminController::class,'editResponsable'])->name('responsable.editResponsable')->middleware('check.role:Administrateur');

Route::GET('/administration/ajouter',
[AdminController::class,'addResponsable'])->name('responsable.addResponsable')->middleware('check.role:Administrateur');

Route::POST('/administration/storeResponsable',
[AdminController::class,'storeResponsable'])->name('responsable.storeResponsable')->middleware('check.role:Administrateur');

Route::GET('/administration/deleteResponsableListe',
[AdminController::class,'deleteResponsableListe'])->name('responsable.deleteResponsableListe')->middleware('check.role:Administrateur');

Route::DELETE('/administration/deleteResponsable/{id}',
[AdminController::class,'deleteResponsable'])->name('responsable.deleteResponsable')->middleware('check.role:Administrateur');

# Liste fournisseur

Route::GET('/responsable/listeFournisseur',
[AdminController::class,'listeFournisseur'])->name('responsable.listeFournisseur')->middleware('check.role:Commis,Gestionnaire,Administrateur');

Route::get('/responsable/fournisseurs/details', 
[AdminController::class, 'detailsFournisseurs'])->name('responsable.detailsFournisseurs')->middleware('check.role:Commis,Gestionnaire,Administrateur');


# Demande de fournisseur
# TODO: Supprimer si view n'existe plus
Route::GET('/responsable/demandeFournisseur',
[AdminController::class,'demandeFournisseurView'])->name('responsable.demandeFournisseur')->middleware('check.role:Commis,Gestionnaie,Administrateur');

# Gestion des status
Route::GET('/responsable/demandeFournisseur/{fournisseur}',
[AdminController::class,'demandeFournisseurZoom'])->name('responsable.demandeFournisseurZoom')->middleware('check.role:Commis,Gestionnaie,Administrateur');

Route::POST('/responsable/demandeFournisseur/{fournisseur}/accepter',
[AdminController::class, 'accepterFournisseur'])->name('responsable.accepterFournisseur')->middleware('check.role:Gestionnaie,Administrateur');

Route::POST('/responsable/demandeFournisseur/{fournisseur}/refuser',
[AdminController::class, 'refuserFournisseur'])->name('responsable.refuserFournisseur')->middleware('check.role:Gestionnaie,Administrateur');

# Téléchargement des fichiers
Route::GET('/responsable/demandeFournisseur/{fournisseur}/fichier/{idFichier}',
[AdminController::class, 'telechargerFichier'])->name('responsable.telechargerFichier')->middleware('check.role:Commis,Gestionnaie,Administrateur');


# Modele de courriel
Route::GET('/responsable/modeleCourriel',
[AdminController::class, 'afficherModelCourriel'])->name('responsable.afficherModelCourriel')->middleware('check.role:Administrateur');

Route::get('/get-template-content', [AdminController::class, 'getModel']);

Route::POST('/responsable/sauvegarderModeleCourriel',
[AdminController::class, 'sauvegarderModelCourriel'])->name('responsable.sauvegarderModelCourriel')->middleware('check.role:Administrateur');


# Exportation
Route::get('/export-csv', [AdminController::class, 'exportCsv'])->name('export.csv');

