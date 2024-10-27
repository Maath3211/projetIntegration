<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ModelCourrielRequest;
use App\Mail\demandeFournisseur;
use App\Models\Contact;
use App\Models\ModelCourriel;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\Fournisseur;
use App\Models\Responsable;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Unspsc;
use App\Models\Unspsccode;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Http\Requests\ConnexionResponsableRequest;
use Carbon\Carbon;
use Mail;
use Str;
use DB;
use Redirect;


class AdminController extends Controller
{

    // RESPONSABLE --- RESPONSABLE --- RESPONSABLE --- RESPONSABLE --- RESPONSABLE --- RESPONSABLE

    public function index()
    {
        return View('responsable.index');
    }

    public function loginEmailResponsable(ConnexionResponsableRequest $request)
    {

        $responsable = Responsable::where('email', $request->email)->where('role', $request->role)->first();

        if ($responsable) {
            session(['responsable' => $responsable]);

            return redirect()->route('responsable.listeFournisseur')->with('message', 'Connexion réussie.');
        } else {
            return redirect()->route('responsable.index')->withErrors(['Informations invalides.']);
        }
    }

    public function affiche()
    {
        return View('responsable.affiche');
    }

    public function listeFournisseur()
    {

        $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');

            if ($response->successful()) {
                $villes = collect($response->json()['result']['records'])->pluck('munnom')->all();
    
            } else {
                $villes = [];
            }


        $fnAttentes = DB::table('fournisseurs')->get();
        $coordonnees = DB::table('coordonnees')->get();
        $nomRegion = DB::table('coordonnees')->distinct()->pluck('nomRegion');
        $nomVille = DB::table('coordonnees')->distinct()->pluck('ville');

        $unspsc = DB::table('unspsccodes')->get();
        $unspscodes = $unspsc->pluck('idUnspsc')->unique();
        $unspscDescription = UNSPSC::whereIn('id', $unspscodes)->distinct()->get(['description']);

        $rbqCategorie = DB::table('categories')->get();
        $rbq = DB::table('rbqlicences')->get();
        $rbqCategorieIds = $rbq->pluck('idCategorie')->unique();
        $codes = Categorie::whereIn('id', $rbqCategorieIds)->distinct()->get(['codeSousCategorie', 'nom']);

        return View('responsable.listeFournisseur',compact('fnAttentes', 'villes','coordonnees','codes', 'nomRegion','nomVille','rbq', 'rbqCategorie','unspscDescription'));
    }

    // ADMINISTRATION --- ADMINISTRATION --- ADMINISTRATION --- ADMINISTRATION --- ADMINISTRATION --- ADMINISTRATION

    public function setting()
    {
        $settings = Setting::latest()->first();
        return View('admin.setting', compact('settings'));
    }

    public function update(SettingRequest $request)
    {
        try {
        } catch (\Throwable $e) {

        }
        $setting = new setting($request->validated());
        $setting->emailAppro = $request->emailAppro;
        $setting->delaiRev = $request->delaiRev;
        $setting->tailleMax = $request->tailleMax;
        $setting->emailFinance = $request->emailFinance;
        $setting->save();

        return redirect()->route('admin.setting');
    }


    // MESSAGE DU SYSTÈME --- MESSAGE DU SYSTÈME --- MESSAGE DU SYSTÈME --- MESSAGE DU SYSTÈME --- MESSAGE DU SYSTÈME --- MESSAGE DU SYSTÈME --- MESSAGE DU SYSTÈME


    public function sendResetPasswordView()
    {
        return view('fournisseur.sendResetPassword');
    }

    public function sendResetPassword(Request $request)
    {
        $now = Carbon::now();

        if (is_numeric($request->identifiant))
            $fournisseur = Fournisseur::where('neq', $request->identifiant)->firstOrFail();
        else
            $fournisseur = Fournisseur::where('email', $request->identifiant)->firstOrFail();

        if ($fournisseur) {
            $fournisseur->codeReset = Str::random(60);
            $fournisseur->demandeReset = $now;
            $fournisseur->save();
            Mail::to($fournisseur->email)->send(new Resetpassword($fournisseur));
        }
        return redirect()->route('fournisseur.index')->with('message', 'Un courriel à été envoyer à l\'adresse associé au compte s\'il existe');
    }



    // TODO: cooldown pour faire demande, apres tant d'essai
    public function resetPasswordView(string $codeReset)
    {
        $now = Carbon::now();

        $fournisseur = Fournisseur::where('codeReset', $codeReset)->firstOrFail();
        $demandeResetDate = Carbon::parse($fournisseur->demandeReset);
        if ($fournisseur->demandeReset && $now->diffInHours($fournisseur->demandeReset) < -0.25) {
            $fournisseur->codeReset = null;
            $fournisseur->demandeReset = null;
            $fournisseur->save();
            return redirect()->route('fournisseur.index')->withErrors('Le code à expiré');
        } else {
            return view('fournisseur.resetPassword', compact('codeReset'));
        }
    }

    public function resetPassword(ResetPasswordRequest $request, string $codeReset)
    {
        $fournisseur = Fournisseur::where('codeReset', $codeReset)->firstOrFail();
        if ($fournisseur->code == $request->codeReset) {
            $fournisseur->password = $request->password;
            $fournisseur->codeReset = null;
            $fournisseur->demandeReset = null;
            $fournisseur->save();
            return redirect()->route('fournisseur.index')->with('message', 'Le mot de passe a été réinitialisé avec succès');
        }
    }

    public function demandeFourn()
    {
        $admins = DB::table('users')->where('role', ['admin', 'responsable'])->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new demandeFournisseur());
        }

    }

    public function demandeFournisseurView()
    {

        $fnAttentes = DB::table('fournisseurs')->where('statut', 'En attente')->get();
        return view('admin.demandeFournisseur', compact('fnAttentes'));
    }

    public function demandeFournisseurZoom($neq)
    {
        $fn = DB::table('fournisseurs')->where('neq', $neq)->first();
        $contacts = DB::table('contact')->where('fournisseur_id', $fn->id)->get();
        $coord = DB::table('coordonnees')->where('fournisseur_id', $fn->id)->get()->firstOrFail();
        $files = DB::table('file')->where('fournisseur_id', $fn->id)->get();
        $rbq = DB::table('rbqlicences')->where('fournisseur_id', $fn->id)->get()->firstOrFail();
        $categories = DB::table('categories')->where('id', $rbq->idCategorie)->get()->firstOrFail();
        $unspscFournisseur = DB::table('unspsccodes')->where('fournisseur_id', $fn->id)->get();
        $unspscCollection = collect();
        foreach ($unspscFournisseur as $uc) {
            $unspsc = DB::table('unspsc')->where('id', $uc->idUnspsc)->first();
            $unspscCollection->push($unspsc);
        }
        $fn->dateStatut = Carbon::parse($fn->dateStatut)->toDateString();
        $fn->created_at = Carbon::parse($fn->created_at)->toDateString();
        $fn->updated_at = Carbon::parse($fn->updated_at)->toDateString();
        if ($fn->raisonRefus)
            $fn->raisonRefus = Crypt::decryptString($fn->raisonRefus);

        return view('admin.zoomDemandeFournisseur', compact('fn', 'contacts', 'coord', 'files', 'rbq', 'categories', 'unspscFournisseur', 'unspscCollection'));
    }

    public function accepterFournisseur($neq)
    {
        try {
            $fn = Fournisseur::where('neq', $neq)->firstOrFail();
            $fn->statut = 'Acceptée';
            $fn->dateStatut = Carbon::now();
            $fn->raisonRefus = null;
            $fn->save();

            return redirect()->route('responsable.demandeFournisseur')->with('message', "Enregistré!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return Redirect::back()->withErrors(['Erreur interne']);
        }

    }

    public function refuserFournisseur($neq, Request $request)
    {
        $request->validate([
            "raisonRefus" => 'required',
        ], [
            "raisonRefus.required" => 'La raison de refus est requise',
        ]);
        $fn = Fournisseur::where('neq', $neq)->firstOrFail();
        $fn->dateStatut = Carbon::now();
        $fn->raisonRefus = Crypt::encryptString($request->raisonRefus);
        $fn->statut = 'Refusé';
        $fn->save();
        return redirect()->route('responsable.demandeFournisseur')->with('message', 'Le fournisseur a été refusé.');
    }

    // neq necessaire meme si pas utilisé, sinon l'id du fichier devient le neq
    public function telechargerFichier($neq, $idFichier)
    {
        $file = DB::table('file')->where('id', $idFichier)->get()->firstOrFail();

        $fichier = public_path($file->lienFichier);
        if (file_exists($fichier)) {
            return response()->download($fichier, $file->nomFichier);
        } else {
            return back()->withErrors('Fichier introuvable');
        }
    }


    public function afficherModelCourriel()
    {
        $modelCourriels = ModelCourriel::all();

        return view('admin.afficherModelCourriel', compact('modelCourriels'));
    }

    public function getModel(Request $request)
    {
        $modelId = $request->input('modelId');
        $modelCourriel = ModelCourriel::findOrFail($modelId);

        return response()->json([
            'sujet' => $modelCourriel->sujet,
            'contenu' => $modelCourriel->contenu
        ]);
    }

    public function saveModelCourriel(ModelCourrielRequest $request)
    {
        $model = ModelCourriel::where('id', $request->model_courriel)->get()->firstOrFail();

        $model->sujet = $request->sujet;
        $model->contenu = $request->contenu;
        $model->save();

        return back();
    }



    // TODO: déplacer dans autre controller
    public function deleteContact($id)
    {
        try {
            $contact = Contact::where('id', $id)->get()->firstOrFail();
            $contact->delete();
            return Redirect::back();
        } catch (\Throwable $e) {
            Log::debug($e);
            return Redirect::back()->withErrors(['Erreur interne']);
        }

    }

    public function editContact($id)
    {
        $contact = Contact::where('id', $id)->get()->firstOrFail();
        
        return view('fournisseur.editContact', compact('contact'));
    }

    public function updateContact($id, ContactRequest $request)
    {
        try {
            $contact = Contact::where('id', $id)->get()->firstOrFail();
            $contact->prenom = $request->prenom;
            $contact->nom = $request->nom;
            $contact->fonction = $request->fonction;
            $contact->courriel = $request->courriel;
            $contact->typeTelephone = $request->typeTelephone;
            $contact->telephone = $request->telephone;
            $contact->poste = $request->poste;

            $contact->save();

            return redirect()->route('responsable.demandeFournisseur');
        } catch (\Throwable $e) {
            Log::debug($e);
            return Redirect::back()->withInput()->withErrors(['Erreur interne']);
        }
    }
}
