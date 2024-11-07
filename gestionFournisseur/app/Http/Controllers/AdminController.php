<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ModelCourrielRequest;
use App\Http\Requests\ResponsableRequest;
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
use App\Models\FournisseurCoord;
use App\Models\Responsable;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Unspsc;
use App\Models\Unspsccode;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Http\Requests\ConnexionResponsableRequest;
use App\Models\RBQLicence;
use Carbon\Carbon;
use Mail;
use Response;
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
        $courrielEnvoye = false;
        $fournisseurs = Fournisseur::where("statut", 'Refusée')->get()->all();
        $parametre = DB::table('setting')->get()->firstOrFail();
        $responsables = Responsable::where('role', ['Administrateur', 'Responsable'])->get();
            foreach($fournisseurs as $fournisseur){
            $date = Carbon::parse($fournisseur->dateStatut);
            if($date->lt(Carbon::now()->subMonths($parametre->delaiRev))){
                $fournisseur->statut = 'Révision';
                $fournisseur->dateStatut = Carbon::now();
                $fournisseur->save();
                if(!$courrielEnvoye){
                    foreach ($responsables as $responsable) 
                    {
                        if ($responsable->email == 'mathys.lessard.02@edu.cegeptr.qc.ca' || $responsable->email == 'simon.beaulieu.04@edu.cegeptr.qc.ca') 
                        {
                            // !!! CHANGER TEMPLATE !!! //
                            Mail::to($responsable->email)->send(new demandeFournisseur());
                        }
                        $courrielEnvoye = true;
                    }
                }   
                
            }
            
        }

        $responsable = Responsable::where('email', $request->email)->where('role', $request->role)->first();

        if ($responsable) 
        {
            session(['responsable' => $responsable]);
            return redirect()->route('responsable.listeFournisseur')->with('message', 'Connexion réussie.');
        } 
        else 
        {
            return redirect()->route('responsable.index')->withErrors(['Informations invalides.']);
        }
    }

    public function affiche()
    {
        return View('responsable.affiche');
    }

    public function listeFournisseur()
    {
        Auth::logout();
        $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');
    
        $villes = $response->successful() ? collect($response->json()['result']['records'])->pluck('munnom')->sort()->all() : []; // Sort the cities alphabetically
    
        $fnAttentes = DB::table('fournisseurs')->get();
        $coordonnees = DB::table('coordonnees')->get();
        $nomRegion = DB::table('coordonnees')->distinct()->pluck('nomRegion');
        $nomVille = DB::table('coordonnees')->distinct()->pluck('ville');
    
        // Récupérer les unspsc pour chaque fournisseur
        $unspsc = DB::table('unspsccodes')
            ->join('unspsc', 'unspsccodes.idUnspsc', '=', 'unspsc.id')
            ->select('unspsccodes.fournisseur_id', 'unspsc.code', 'unspsc.description', 'unspsc.id')
            ->get()
            ->groupBy('fournisseur_id');
    
        // Récupérer toutes les descriptions UNSPSC
        $unspscDescription = DB::table('unspsc')->distinct()->get(['description']);
    
        $rbqCategorie = DB::table('categories')->get();
        $rbq = DB::table('rbqlicences')->get();
        $rbqCategorieIds = $rbq->pluck('idCategorie')->unique();
        $codes = Categorie::whereIn('id', $rbqCategorieIds)->distinct()->get(['codeSousCategorie', 'nom']);
            
        return view('responsable.listeFournisseur', compact('fnAttentes', 'villes', 'coordonnees', 'codes', 'nomRegion', 'nomVille', 'rbq', 'rbqCategorie', 'unspsc', 'unspscDescription'));
    }

    public function detailsFournisseurs(Request $request)
    {
        $ids = explode(',', $request->query('ids', ''));
        
        // Load fournisseurs with related contacts and coordonnees
        $fournisseurs = Fournisseur::whereIn('id', $ids)
            ->with(['contacts', 'coordonnees'])
            ->get();
    
            
        return view('responsable.detailsFournisseurs', compact('fournisseurs'));
    }
    

    
    

    public function exportCsv(Request $request)
    {
        $supplierIds = explode(',', $request->query('supplier_ids'));
    
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=fournisseurs.csv",
        ];
    
        $callback = function() use ($supplierIds) {
            $file = fopen('php://output', 'w');
    
            // Add the header row
            fputcsv($file, ['Entreprise', 'Courriel', 'Telephone', 'Contacts', 'Statut']);
    
            // Fetch only selected suppliers
            $fnAttentes = DB::table('fournisseurs')->whereIn('id', $supplierIds)->get();
            $coordonnees = DB::table('coordonnees')->whereIn('fournisseur_id', $supplierIds)->get();
            $rbq = DB::table('rbqlicences')->whereIn('fournisseur_id', $supplierIds)->get();
            $contacts = DB::table('contact')->whereIn('fournisseur_id', $supplierIds)->get();
            $rbqCategorie = DB::table('categories')->get();
            $unspsc = DB::table('unspsccodes')
                        ->join('unspsc', 'unspsccodes.idUnspsc', '=', 'unspsc.id')
                        ->select('unspsccodes.fournisseur_id', 'unspsc.code', 'unspsc.description')
                        ->whereIn('unspsccodes.fournisseur_id', $supplierIds)
                        ->get()
                        ->groupBy('fournisseur_id');
    
            foreach ($fnAttentes as $fn) {
                $coord = $coordonnees->firstWhere('fournisseur_id', $fn->id);
                $rbqLicence = $rbq->firstWhere('fournisseur_id', $fn->id);
                $rbqCategorieNom = $rbqLicence ? $rbqCategorie->firstWhere('id', $rbqLicence->idCategorie)->nom ?? 'Non disponible' : 'Non disponible';
    
                // Récupérer et concaténer les contacts
                $contactsForSupplier = $contacts->where('fournisseur_id', $fn->id);
                $contactDetails = $contactsForSupplier->map(function($contact) {
                    return $contact->prenom . ' ' . $contact->nom . ' (' . $contact->courriel . ', ' . $contact->telephone . ')';
                })->implode('; ');
    
                $unspscCodes = isset($unspsc[$fn->id]) ? implode(', ', $unspsc[$fn->id]->map(fn($code) => "$code->code - $code->description")->all()) : 'Non disponible';
    
                fputcsv($file, [
                    $fn->entreprise,
                    $fn->email,
                    $coord->numero ?? 'Non disponible',
                    $contactDetails ?: 'Non disponible',
                    // $fn->neq,
                    $fn->statut,
                    // $coord ? $coord->ville : 'Non disponible',
                    // $rbqCategorieNom,
                    // $unspscCodes,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
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
        $fournisseur = DB::table('fournisseurs')->where('neq', $neq)->first();
        $contacts = DB::table('contact')->where('fournisseur_id', $fournisseur->id)->get();
        $coordonnees = DB::table('coordonnees')->where('fournisseur_id', $fournisseur->id)->get()->firstOrFail();
        $numero = $coordonnees->numero;
        $numero = substr($numero, 0, 3) . '-' . substr($numero, 3, 3) . '-' . substr($numero, 6);
        $numero2 = $coordonnees->numero;
        $numero2 = substr($numero2, 0, 3) . '-' . substr($numero2, 3, 3) . '-' . substr($numero2, 6);
        $codePostal = $coordonnees->codePostal;
        $codePostal = substr($codePostal, 0, 3) . ' ' . substr($codePostal, 3);
        $files = DB::table('file')->where('fournisseur_id', $fournisseur->id)->get();
        $rbq = DB::table('rbqlicences')->where('fournisseur_id', $fournisseur->id)->get()->firstOrFail();
        $categories = DB::table('categories')->where('id', $rbq->idCategorie)->get()->firstOrFail();
        $unspscFournisseur = DB::table('unspsccodes')->where('fournisseur_id', $fournisseur->id)->get();
        $unspscCollection = collect();
        foreach ($unspscFournisseur as $uc) {
            $unspsc = DB::table('unspsc')->where('id', $uc->idUnspsc)->first();
            $unspscCollection->push($unspsc);
        }
        $fournisseur->dateStatut = Carbon::parse($fournisseur->dateStatut)->toDateString();
        $fournisseur->created_at = Carbon::parse($fournisseur->created_at)->toDateString();
        $fournisseur->updated_at = Carbon::parse($fournisseur->updated_at)->toDateString();
        if ($fournisseur->raisonRefus)
            $fournisseur->raisonRefus = Crypt::decryptString($fournisseur->raisonRefus);

        return view('admin.zoomDemandeFournisseur', compact('fournisseur', 'contacts', 'coordonnees', 'files', 'rbq', 'categories', 'unspscFournisseur', 'unspscCollection','numero','numero2','codePostal'));
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

    public function gererResponsable(){
        $responsables = Responsable::get()->all();
        return view('admin.role', compact('responsables'));
    }
    public function editResponsable($id, ResponsableRequest $request){
        
        $listeResponsable = Responsable::all();
        $nbAdministrateur = 0;
        $nbResponsable = 0;
        foreach($listeResponsable as $respo){
            if($respo->role == 'Administrateur')
                $nbAdministrateur++;
            elseif($respo->role == 'Responsable')
                $nbResponsable++;
        }
        $responsable = Responsable::where('id', $id)->get()->firstOrFail();
        switch($responsable->role){
            case('Commis'):
                $responsable->role = $request->role;
                    $responsable->save();
                    return back();

            case('Responsable'):
                if($responsable->role == 'Responsable' && $nbResponsable > 1){
                    $responsable->role = $request->role;
                    $responsable->save();
                    return back();
                }
                else{
                    return back()->withErrors('Impossible d\'enlever le dernier responsable');
                }

            case('Administrateur'):
                if($responsable->role == 'Administrateur' && $nbAdministrateur > 1){
                    $responsable->role = $request->role;
                    $responsable->save();
                    return back();
                }
                else{
                    return back()->withErrors('Impossible d\'enlever le dernier administrateur');
                }
        }

    }

    public function addResponsable(){
        return view('admin.addResponsable');
    }
    public function storeResponsable(ResponsableRequest $request){
        $responsable = new Responsable();
        $responsable->email = $request->email;
        $responsable->role = $request->role;
        $responsable->save();
        return back();
    }

    public function deleteResponsableListe(){
        $responsables = Responsable::get()->all();
        return view('admin.deleteResponsableListe', compact('responsables'));
    }

    public function deleteResponsable($id){
        $responsable = Responsable::where('id', $id);
        $responsable->delete();

        return back();
    }

    


}
