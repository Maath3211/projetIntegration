<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Fournisseur;
use App\Models\Unspsc;
use App\Models\Unspsccode;
use App\Models\RBQLicence;
use App\Models\Categorie;
use App\Models\FournisseurCoord;
use App\Models\Contact;
use App\Models\File;
use App\Models\Finance;
use App\Models\Setting;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\FournisseurNeqRequest;
use App\Http\Requests\FournisseurEditRequest;
use App\Http\Requests\FournisseurRequest;
use App\Http\Requests\UnspscRequest;
use App\Http\Requests\RBQRequest;
use App\Http\Requests\FournisseurCoordRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\FinanceRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\recevoirConfirmation;
use App\Mail\demandeFournisseur;
use Carbon\Carbon;
use Mail;
use DB;
use Illuminate\Contracts\View\View;
use Redirect;

class PortailFournisseurController extends Controller
{

    /**
     * CONNEXION **** CONNEXION **** CONNEXION ****CONNEXION ****CONNEXION****CONNEXION **** CONNEXION ****CONNEXION ****
    */

     public function loginEmail(ConnexionRequest $request)
     {
         $reussi = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
 
         if ($reussi) 
         {
             $fournisseurEmail = Fournisseur::where('email', $request->email)->firstOrFail();
             return redirect()->route('fournisseur.information');
         } 
         else 
         {
             return redirect()->route('fournisseur.index')->withErrors(['Informations invalides']);
         }
     }

    public function loginNeq(ConnexionRequest $request)
    {
        $reussi = Auth::guard('users')->attempt( ['neq' => $request->neq, 'password' => $request->password]);

        if ($reussi) 
        {
            $fournisseurNeq = Fournisseur::where('neq', $request->neq)->firstOrFail();
            return redirect()->route('fournisseur.information');
        } 
        else 
        {
            return redirect()->route('fournisseur.index')->withErrors(['Informations invalides']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('fournisseur.index')->with('message', 'Déconnecté avec succès');
    }

    /**
     * VIEW **** VIEW **** VIEW ****VIEW ****VIEW****VIEW **** VIEW ****VIEW ****
    */

    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return View('fournisseur.index');
    }

    public function infoLogin()
    {
        $fournisseur = Auth::user();
        $numero = $this->formatPhoneNumber($fournisseur->coordonnees->numero);
        $numero2 = $this->formatPhoneNumber($fournisseur->coordonnees->numero2);
        $codePostal = $this->formatPostalCode($fournisseur->coordonnees->codePostal);
        $rbq = RBQLicence::where('fournisseur_id', $fournisseur->id)->first();
        $categorie = Categorie::where('id', $rbq->idCategorie)->first();
        $unspscFournisseur = DB::table('unspsccodes')->where('fournisseur_id', $fournisseur->id)->get();
        $unspscCollection = collect();
        foreach ($unspscFournisseur as $uc) 
        {
            $unspsc = DB::table('unspsc')->where('id', $uc->idUnspsc)->first();
            $unspscCollection->push($unspsc);
        }

        if ($fournisseur->statut === "Acceptée" && !$fournisseur->finance) 
        {
            return redirect()->route('fournisseur.finances');
        }
        // elseif($fournisseur->statut === "Acceptée")
        // {
        //     $finance = Finance::where('fournisseur_id', $fournisseur->id)->first();
        // }s
        //dd($unspscFournisseur);
             
        
        return View('fournisseur.information', compact('fournisseur','rbq','categorie','unspscCollection','unspscFournisseur',   'numero','numero2','codePostal'));
    }


    public function storeDesactive()
    {
        try 
        {
            $neq = Auth::user()->neq;
            $fournisseurId = Auth::user()->id;
            $fournisseur = Fournisseur::where('neq', $neq)->firstOrFail();
            $fournisseur->statut = 'Désactivée';
            $fournisseur->dateStatut = Carbon::now();
            $files = File::where('fournisseur_id', $fournisseurId)->get();
            $destination = public_path('images/fournisseurs/');

            foreach ($files as $file) 
            {
                $filePath = $destination . $file->nomFichier;

                if (file_exists($filePath)) 
                {
                    unlink($filePath);
                }
                $file->delete();
            }

            $fournisseur->save();

            return redirect()->route('fournisseur.information')->with('message', "Fournisseur désactivé et fichiers supprimés !");

        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.information')->withErrors(['Informations invalides']);
        }
    }

    public function storeActive()
    {
        try 
        {
            $neq = Auth::user()->neq;
            $fournisseur = Fournisseur::where('neq', $neq)->firstOrFail();
            $fournisseur->statut = 'Acceptée';
            $fournisseur->dateStatut = Carbon::now();
            $fournisseur->save();
            return redirect()->route('fournisseur.information')->with('message', "Enregistré!");
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.information')->withErrors(['Informations invalides']);
        }
    }

    //Identification

    public function inscription()
    {
        return view('fournisseur.inscription');
    }

    public function storeInscription(FournisseurNeqRequest $request)
    {
        try 
        {
            session([
                'fournisseurNEQ' => [
                    'neq' => $request->neq
                ]
            ]);



            return redirect()->route('fournisseur.identification')->with('message', "Enregistré!");
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.identification')->withErrors(['Informations invalides']);
        }
    }

    public function createIdentification()
    {
        $fournisseurNeqData = session('fournisseurNEQ');
        $neq = $fournisseurNeqData['neq'] ?? null;
        $entrepriseNeq = null;
        $emailNeq = null;

        if ($neq) 
        {
            $responseNeq = Http::withoutVerifying()->get("https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20*%20FROM%20%2232f6ec46-85fd-45e9-945b-965d9235840a%22%20WHERE%20%22NEQ%22%20=%20'{$neq}'");

            if ($responseNeq->successful()) 
            {
                $infoTrouve = $responseNeq->json();

                if (!empty($infoTrouve['result']['records'])) 
                {
                    $entrepriseNeq = $infoTrouve['result']['records'][0]['Nom de l\'intervenant'] ?? null;
                    $emailNeq = $infoTrouve['result']['records'][0]['Courriel'] ?? null;
                }
            }
        }

        return view('fournisseur.identification', compact('neq', 'entrepriseNeq', 'emailNeq'));
    }


    public function storeIdentification(FournisseurRequest $request)
    {
        try 
        {
            session([
                'fournisseur' => [
                    'neq' => $request->neq,
                    'entreprise' => ucfirst($request->entreprise),
                    'email' => strtolower($request->email),
                    'password' => ($request->password)
                ]
            ]);

            return redirect()->route('fournisseur.coordonnees')->with('message', "Enregistré!");
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.identification')->withErrors(['Informations invalides']);
        }
    }

    public function editIdentification()
    {
        $fournisseur = Auth::user();
        $email = $fournisseur->email;
        $neq = $fournisseur->neq;
        $entreprise = $fournisseur->entreprise;
        return view('fournisseur.editIdentification', compact('email', 'neq', 'entreprise'));
    }

    public function updateIdentification(FournisseurEditRequest $request)
    {
        $fournisseur = Auth::user();

        $fournisseur->entreprise = $request->entreprise;
        $fournisseur->email = $request->email;
        $fournisseur->save();

        return redirect()->route('fournisseur.information')->with('message', 'Informations mises à jour avec succès.');
    }

    public function editPassword()
    {
        return view('fournisseur.editPassword');
    }

    public function updatePassword(ResetPasswordRequest $request)
    {
        $fournisseur = Auth::user();
        $fournisseur->password = $request->password;
        $fournisseur->save();

        return redirect()->route('fournisseur.information')->with('message', 'Informations mises à jour avec succès.');
    }


    // Coordonnées

    public function createCoordo()
    {
        $fournisseurData = session('fournisseur');

        if (!$fournisseurData) 
        {
            return redirect()->route('fournisseur.identification')->withErrors(['Erreur, Recommencer']);
        }

        $fournisseurData = session('fournisseur');
        $neq = $fournisseurData['neq'] ?? null;
        $villeNeq = null;
        $noCivicNeq = null;
        $rueNeq = null;
        $codePostalNeq = null;
        $telNeq = null;
        $telNeqAff = null;

        if ($neq) 
        {
            $responseNeq = Http::withoutVerifying()->get("https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20*%20FROM%20%2232f6ec46-85fd-45e9-945b-965d9235840a%22%20WHERE%20%22NEQ%22%20=%20'{$neq}'");

            if ($responseNeq->successful()) 
            {
                $infoTrouve = $responseNeq->json();

                if (!empty($infoTrouve['result']['records'])) 
                {
                    $villeNeq = $infoTrouve['result']['records'][0]['Municipalite'] ?? null;
                    $adresseTrouve = $infoTrouve['result']['records'][0]['Adresse'] ?? null;
                    $telNeq = $infoTrouve['result']['records'][0]['Numero de telephone'] ?? null;
                    $telNeqAff = substr($telNeq, 0, 3) . '-' . substr($telNeq, 3, 3) . '-' . substr($telNeq, 6);

                    if (!empty($adresseTrouve)) 
                    {
                        $division = explode(' ', $adresseTrouve);
                        $noCivicNeq = $division[0] ?? null;
                        $rechercheProvince = array_search('QC', $division);
                        $rueNeq = implode(' ', array_slice($division, 1, $rechercheProvince - 2));
                        $codePostalNeq = implode(' ', array_slice($division, -2));
                        $codePostalNeq = str_replace(' ', '', $codePostalNeq);
                    }
                }
            }
        }

        $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');

        if ($response->successful()) 
        {
            $villes = collect($response->json()['result']['records'])->pluck('munnom')->all();
        } 
        else 
        {
            $villes = [];
        }

        return view('fournisseur.coordonnees', compact('villes', 'villeNeq', 'noCivicNeq', 'rueNeq', 'codePostalNeq', 'telNeqAff'));
    }


    public function storeCoordo(FournisseurCoordRequest $request)
    {
        try 
        {
            $nomRegion = "";
            $codeRegion = "";
            $villeChoisie = $request->input('ville');
            $provinceChoisie = $request->input('province');

            if ($provinceChoisie === 'Québec') 
            {
                $responseVille = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22%20WHERE%20%22munnom%22=%27' . urlencode($villeChoisie) . '%27');
                if ($responseVille->successful() && count($responseVille->json()['result']['records']) > 0) 
                {
                    $regionTrouve = $responseVille->json()['result']['records'][0]['regadm'];

                    if (!empty($regionTrouve)) 
                    {
                        $nomRegion = rtrim(strtok($regionTrouve, '('));
                        $codeRegion = trim(strtok('()'));
                    }
                }
            }

            session([
                'coordonnees' => [
                    'noCivic' => $request->noCivic,
                    'rue' => $request->rue,
                    'bureau' => $request->bureau,
                    'ville' => $request->ville,
                    'province' => $request->province,
                    'codePostal' => strtoupper($request->codePostal),
                    'codeRegion' => $codeRegion,
                    'nomRegion' => $nomRegion,
                    'site' => strtolower($request->site),
                    'typeTel' => $request->typeTel,
                    'numero' => $request->numero,
                    'poste' => $request->poste,
                    'typeTel2' => $request->typeTel2,
                    'numero2' => $request->numero2,
                    'poste2' => $request->poste2,
                ]
            ]);

            return redirect()->route('fournisseur.contact')->with('message', "Enregistré!");
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.coordonnees')->withErrors(['Informations invalides']);
        }
    }

    public function editCoordonnees($id = null)
    {
        $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');

        if ($response->successful()) 
        {
            $villes = collect($response->json()['result']['records'])->pluck('munnom')->all();
        } 
        else 
        {
            $villes = [];
        }

        // nouveau code teste //
        $fournisseur = $id ? Fournisseur::findOrFail($id) : Auth::user();
        if (!$fournisseur) {
            return redirect()->route('fournisseur.information')->withErrors(['Fournisseur introuvable']);
        }
        // nouveau code teste //
        //$fournisseur = Auth::user(); 
        $coordonnees = $fournisseur->coordonnees;
        $numero = $coordonnees->numero;
        $numero = substr($numero, 0, 3) . '-' . substr($numero, 3, 3) . '-' . substr($numero, 6);
        $numero2 = $coordonnees->numero;
        $numero2 = substr($numero2, 0, 3) . '-' . substr($numero2, 3, 3) . '-' . substr($numero2, 6);
        $codePostal = $coordonnees->codePostal;
        $codePostal = substr($codePostal, 0, 3) . ' ' . substr($codePostal, 3);
    
        return view('fournisseur.editCoordonnees', compact('coordonnees', 'villes','fournisseur','numero','numero2','codePostal')); //founisseur ajouté
    }

    public function updateCoordonnees(FournisseurCoordRequest $request, $id = null)
    {
        // nouveau code //
        $responsable = false;
        $fournisseur = null;
        $fournisseur = Fournisseur::find(Auth::id());
        if($fournisseur == null){
            $responsable = true;
            $fournisseur = Fournisseur::where('id',$id)->first();
            
        }
        // nouveau code //
        try 
        {
            $nomRegion = "";
            $codeRegion = "";
            $villeChoisie = $request->input('ville');
            $provinceChoisie = $request->input('province');

            if ($provinceChoisie === 'Québec') {
                $responseVille = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22%20WHERE%20%22munnom%22=%27' . urlencode($villeChoisie) . '%27');
                if ($responseVille->successful() && count($responseVille->json()['result']['records']) > 0) 
                {
                    $regionTrouve = $responseVille->json()['result']['records'][0]['regadm'];

                    if (!empty($regionTrouve)) 
                    {
                        $nomRegion = rtrim(strtok($regionTrouve, '('));
                        $codeRegion = trim(strtok('()'));
                    }
                }
            }
            // nouveau code ici //
           // $fournisseur = $id ? Fournisseur::findOrFail($id) : Auth::user();
        
            if (!$fournisseur) {
                return redirect()->route('fournisseur.information')->withErrors(['Fournisseur introuvable']);
            }
            // nouveau code ici //
            //$fournisseur = Auth::user();
            $coordonnees = FournisseurCoord::where('fournisseur_id', $fournisseur->id)->first();

            if (!$coordonnees) 
            {
                return redirect()->route('fournisseur.information')->withErrors(['Coordonnées introuvables pour ce fournisseur']);
            }

            $coordonnees->fill($request->validated());
            $coordonnees->codeRegion = $codeRegion;
            $coordonnees->nomRegion = $nomRegion;
            $coordonnees->codePostal = strtoupper($request->codePostal);
            $coordonnees->site = strtolower($request->site);
            $coordonnees->save();
            $fournisseur->touch(); // nouveau code //
            //return redirect()->route('fournisseur.information')->with('message', "Enregistré!");
            // nouvau code //
            if($responsable){
                return redirect()->route('responsable.demandeFournisseurZoom', [$fournisseur->neq])->with('message', 'Coordonnées à jour');
            }
            else{
                return redirect()->route('fournisseur.information')->with('message', 'Coordonnées à jour');
            }
            // nouvau code //
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.information')->withErrors(['Informations invalides']);
        }
    }

    // Contact

    public function contact()
    {

        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');

        if (is_null($fournisseurData) || is_null($coordonneesData)) {
            return redirect()->route('fournisseur.coordonnees')->withErrors(['Les informations du fournisseur ou des coordonnées sont manquantes.']);
        }

        return view('fournisseur.ajoutContact');
    }

    public function storeContact(ContactRequest $request)
    {
        $contact = session('contact', []);
        try {
            $contact[] = [
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'fonction' => $request->fonction,
                'courriel' => $request->courriel,
                'typeTelephone' => $request->typeTelephone,
                'telephone' => $request->telephone,
                'poste' => $request->poste,
            ];

            session(['contact' => $contact]);

            if ($request->input('action') === 'save_next') {
                return redirect()->route('fournisseur.UNSPSC')->with('message', "Enregistré!");

            }
            return redirect()->back();


        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('fournisseur.index')->withErrors(['Informations invalides']);
        }
    }

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

    public function addContactCreer($id){
        session(['return_to' => url()->previous()]);
        $fournisseur = Fournisseur::where('id', $id)->firstOrFail();
        return view('fournisseur.ajoutContactCreer', compact('fournisseur'));
    }

    public function storeContactCreer($id, ContactRequest $request){
        try{
        $contact = new Contact();

        $contact->prenom = $request->prenom;
        $contact->nom = $request->nom;
        $contact->fonction = $request->fonction;
        $contact->courriel = $request->courriel;
        $contact->typeTelephone = $request->typeTelephone;
        $contact->telephone = $request->telephone;
        $contact->poste = $request->poste;
        $contact->fournisseur_id = $id;
        $contact->save();
        $return_url = session('return_to');
        session()->forget('return_to');
        return redirect($return_url);
    }catch (\Throwable $e) {
        Log::debug($e);
        return Redirect::back()->withInput()->withErrors(['Erreur interne']);
    }
    }

    public function editContact($id)
    {
        session(['return_to' => url()->previous()]);
        $contact = Contact::where('id', $id)->get()->firstOrFail();
        
        return view('fournisseur.editContact', compact('contact'));
    }

    public function updateContact($id, ContactRequest $request)
    {
        try {
            $return_url = session('return_to');
            $contact = Contact::where('id', $id)->get()->firstOrFail();
            $contact->prenom = $request->prenom;
            $contact->nom = $request->nom;
            $contact->fonction = $request->fonction;
            $contact->courriel = $request->courriel;
            $contact->typeTelephone = $request->typeTelephone;
            $contact->telephone = $request->telephone;
            $contact->poste = $request->poste;

            $contact->save();
            session()->forget('return_to');
            return redirect($return_url);
        } catch (\Throwable $e) {
            Log::debug($e);
            return Redirect::back()->withInput()->withErrors(['Erreur interne']);
        }
    }

    // Code Unspsc 

    public function UNSPSC(Request $request)
    {
        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');
        $contactData = session('contact');

        if (is_null($fournisseurData) || is_null($coordonneesData) || is_null($contactData)) {
            return redirect()->route('fournisseur.contact')->withErrors(['Les informations du fournisseur, des coordonnées ou du contact sont manquantes.']);
        }

        $codes = Unspsc::limit(20904)->get();
        //20904
        //$codes = Unspsc::paginate(1000);



        return view('fournisseur.UNSPSC', compact('codes'));

    }


    public function storeUnspsc(UnspscRequest $request)
    {
        try {
            session([
                'UNSPSC' => [
                    'details' => $request->details,
                    'idUnspsc' => $request->idUnspsc
                ]
            ]);

            return redirect()->route('fournisseur.RBQ')->with('message', "Enregistré!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('fournisseur.UNSPSC')->withErrors(['Informations invalides']);
        }
    }

    public function editUNSPSC($id)
    {
        $fournisseur = Auth::user();
        if($fournisseur == null){
            $fournisseur = Fournisseur::where('id',$id)->first();
        }
        
        $unspscFournisseur = DB::table('unspsccodes')->where('fournisseur_id', $fournisseur->id)->get();
        $unspscDetails= DB::table('unspsccodes')->where('fournisseur_id', $fournisseur->id)->first();
        $unspscChamp = DB::table('unspsccodes')->where('fournisseur_id', $fournisseur->id)->pluck('idUnspsc')->toArray();
        $codes = Unspsc::limit(20904)->get();
        return View('fournisseur.editUNSPSC', compact('unspscFournisseur', 'codes','unspscChamp', 'unspscDetails'));
    }

    public function updateUNSPSC(UnspscRequest $request, $id)
    {
    
        $responsable = false;
    $fournisseur = Fournisseur::find(Auth::id());
    if($fournisseur == null){
        $responsable = true;
        $fournisseur = Fournisseur::where('id',$id)->first();
    }

    $unspscData = $request->input('idUnspsc', []); 
    try {
        $existingUnspsc = Unspsccode::where('fournisseur_id', $fournisseur->id)->get();

        $existingUnspscIds = $existingUnspsc->pluck('idUnspsc')->toArray();

        foreach ($unspscData as $index => $unspscId) {
            $unspsc = Unspsccode::where('fournisseur_id', $fournisseur->id)
                        ->where('idUnspsc', $unspscId)
                        ->first();

            if ($unspsc) {
                $unspsc->details = $request->details ?? '';
            } else {
                $unspsc = new Unspsccode();
                $unspsc->fournisseur_id = $fournisseur->id;
                $unspsc->idUnspsc = $unspscId;
                $unspsc->details = $request->details ?? '';
            }
            $unspsc->save();
        }

        $unspscToDelete = array_diff($existingUnspscIds, $unspscData);
        if (!empty($unspscToDelete)) {
            Unspsccode::where('fournisseur_id', $fournisseur->id)
                ->whereIn('idUnspsc', $unspscToDelete)
                ->delete();
        }

            $fournisseur->touch();


            if($responsable){
                return redirect()->route('responsable.demandeFournisseurZoom', [$fournisseur->id])->with('message', 'Code UNSPSC mise à jour avec succès');
            }
            else{
                return redirect()->route('fournisseur.information')->with('message', 'Code UNSPSC mise à jour avec succès');
            }
        } catch (\Throwable $e) {
            Log::error($e);
            return redirect()->route('fournisseur.UNSPSC.edit',[$fournisseur->id])->withErrors(['Erreur lors de la mise à jour des codes UNSPSC']);
        }
    }
    
    // Licence RBQ

    public function RBQ()
    {

        $fournisseurData = session('fournisseur');
        $neq = $fournisseurData['neq'] ?? null;
        $coordonneesData = session('coordonnees');
        $contactData = session('contact');
        $unspscData = session('UNSPSC');

        if (is_null($fournisseurData) || is_null($coordonneesData) || is_null($contactData) || is_null($unspscData)) {
            return redirect()->route('fournisseur.UNSPSC')->withErrors(['Les informations du fournisseur, des coordonnées, du contact ou du code UNSPSC sont manquantes.']);
        }




        $codes = Categorie::all();
        // Requête vers l'API

        $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22Numero%20de%20licence%22,%20%22Statut%20de%20la%20licence%22,%20%22Categorie%22,%20%22Sous-categories%22,%20%22NEQ%22,%20%22Type%20de%20licence%22,%20%22Restriction%22%20FROM%20%2232f6ec46-85fd-45e9-945b-965d9235840a%22%20WHERE%20%22NEQ%22%20=%20%27' . $neq . '%27%20AND%20%22Categorie%22%20%3C%3E%20%27null%27');
        //$url = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22Numero%20de%20licence%22,%20%22Statut%20de%20la%20licence%22,%20%22Categorie%22,%20%22Sous-categories%22,%20%22Type%20de%20licence%22,%20%22Restriction%22%20FROM%20%2232f6ec46-85fd-45e9-945b-965d9235840a%22%20WHERE%20%22NEQ%22%20=%20%27' . $neqFournisseur . '%27%20AND%20%22Categorie%22%20%3C%3E%20%27null%27';

        if ($response->successful()) {
            // Récupérer uniquement le premier enregistrement
            $record = collect($response->json()['result']['records'])->first();

            // Extraire les informations si disponibles
            $numRBQ = $record['Numero de licence'] ?? null;
            $statutRBQ = $record['Statut de la licence'] ?? null;
            $typeLicence = $record['Type de licence'] ?? null;
            $categorie = $record['Categorie'] ?? null;
            $sousCategories = $record['Sous-categories'] ?? null;
            $restriction = $record['Restriction'] ?? null;
        } else {
            // Valeurs par défaut si l'API ne renvoie rien
            $numRBQ = null;
            $statutRBQ = null;
            $typeLicence = null;
            $categorie = null;
            $sousCategories = null;
            $restriction = null;
        }


        // Passer les données à la vue
        return view('fournisseur.RBQ', compact('codes', 'numRBQ', 'statutRBQ', 'typeLicence', 'categorie', 'sousCategories', 'restriction'));
    }

    public function storeRBQ(RBQRequest $request)
    {
        try {
            session([
                'RBQ' => [
                    'licenceRBQ' => $request->licenceRBQ,
                    'statut' => $request->statut,
                    'typeLicence' => $request->typeLicence,
                    'idCategorie' => $request->idCategorie
                ]
            ]);

            // $code = new RBQLicence($request->validated());
            // $code->save();

            return redirect()->route('fournisseur.importation')->with('message', "Enregistré!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('fournisseur.RBQ')->withErrors(['Informations invalides']);
        }
    }

    public function editRBQ(RBQLicence $rbqLicence, $id)
    {

        $fournisseur = Fournisseur::find(Auth::id());
        if($fournisseur == null){
            $fournisseur = Fournisseur::where('id',$id)->first();
        }

        $rbq = RBQLicence::where('fournisseur_id', $fournisseur->id)->first();
        $codes = Categorie::all();
        $neq = $fournisseur->neq;



        $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22Numero%20de%20licence%22,%20%22Statut%20de%20la%20licence%22,%20%22Categorie%22,%20%22Sous-categories%22,%20%22NEQ%22,%20%22Type%20de%20licence%22,%20%22Restriction%22%20FROM%20%2232f6ec46-85fd-45e9-945b-965d9235840a%22%20WHERE%20%22NEQ%22%20=%20%27' . $neq . '%27%20AND%20%22Categorie%22%20%3C%3E%20%27null%27');
        //$url = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22Numero%20de%20licence%22,%20%22Statut%20de%20la%20licence%22,%20%22Categorie%22,%20%22Sous-categories%22,%20%22Type%20de%20licence%22,%20%22Restriction%22%20FROM%20%2232f6ec46-85fd-45e9-945b-965d9235840a%22%20WHERE%20%22NEQ%22%20=%20%27' . $neqFournisseur . '%27%20AND%20%22Categorie%22%20%3C%3E%20%27null%27';

        if ($response->successful()) {
            // Récupérer uniquement le premier enregistrement
            $record = collect($response->json()['result']['records'])->first();

            // Extraire les informations si disponibles
            $numRBQ = $record['Numero de licence'] ?? null;
            $statutRBQ = $record['Statut de la licence'] ?? null;
            $typeLicence = $record['Type de licence'] ?? null;
            $categorie = $record['Categorie'] ?? null;
            $sousCategories = $record['Sous-categories'] ?? null;
            $restriction = $record['Restriction'] ?? null;
        } else {
            // Valeurs par défaut si l'API ne renvoie rien
            $numRBQ = null;
            $statutRBQ = null;
            $typeLicence = null;
            $categorie = null;
            $sousCategories = null;
            $restriction = null;
        }


        return View('fournisseur.editRBQ', compact('rbq', 'codes', 'numRBQ', 'statutRBQ', 'typeLicence', 'categorie', 'sousCategories', 'restriction', 'rbqLicence'));
    }


    public function updateRBQ(RBQRequest $request, $id)
    {
        $responsable = false;
        // Récupérer l'utilisateur authentifié
        $fournisseur = Fournisseur::find(Auth::id());
        if($fournisseur == null){
            $responsable = true;
            $fournisseur = Fournisseur::where('id',$id)->first();
            
        }

        // Récupérer l'enregistrement RBQLicence existant via l'ID
        $rbq = RBQLicence::where('fournisseur_id', $fournisseur->id)->first();


        // Vérifier si l'enregistrement existe avant de procéder à la mise à jour
        if (!$rbq) {
            return redirect()->route('fournisseur.RBQ.edit')->withErrors(['Licence RBQ non trouvée']);
        }

        try {
            // Mettre à jour les données avec celles du formulaire
            $rbq->licenceRBQ = $request->licenceRBQ;
            $rbq->statut = $request->statut;
            $rbq->typeLicence = $request->typeLicence;
            $rbq->idCategorie = $request->idCategorie;
            $rbq->fournisseur_id = $fournisseur->id;

            // Sauvegarder les modifications
            $rbq->save();
            $fournisseur->touch();
            // Rediriger avec un message de succès

            if($responsable){
                return redirect()->route('responsable.demandeFournisseurZoom', [$fournisseur->id])->with('message', 'Licence RBQ mise à jour avec succès');
            }
            else{
                return redirect()->route('fournisseur.information')->with('message', 'Licence RBQ mise à jour avec succès');
            }
        } catch (\Throwable $e) {
            // En cas d'erreur, enregistrer l'exception dans les logs et rediriger avec une erreur
            Log::debug($e);
            return redirect()->route('fournisseur.RBQ.edit')->withErrors(['Erreur lors de la mise à jour de la licence RBQ']);
        }
    }

   
    // Importation et !! SAUVEGARDE DES INFORMATIONS !!
    public function importation()
    {
        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');
        $contactData[] = session('contact');
        $unspscData = session('UNSPSC');
        $rbqData = session('RBQ');

        if (is_null($fournisseurData) || is_null($coordonneesData) || is_null($contactData) || is_null($rbqData) || is_null($unspscData)) 
        {
            return redirect()->route('fournisseur.UNSPSC')->withErrors(['Les informations requises sont manquantes. Veuillez compléter toutes les étapes précédentes.']);
        }

        return view('fournisseur.importationImg');
    }

    public function storeImportation(Request $request)
    {

        if ($request->hasFile('images')) 
        {
            $maxSize = Setting::latest()->first()->tailleMax * 1024;

            foreach ($request->file('images') as $key => $image) 
            {
                try 
                {
                    $request->validate([
                        "images.{$key}" => 'required|max:' . $maxSize . '|mimes:pdf,doc,docx,jpg,jpeg,png,xlsx,xls,csv,txt',
                    ], [
                        "images.{$key}.max" => 'Le fichier est au-dessus de la limite définie',
                        "images.{$key}.required" => 'L\'image est requise',
                        "images.{$key}.mimes" => 'Le fichier doit être dans un format imprimable: JPG, PNG, DOCX, DOC, PDF, XLSX, XLS, CSV'
                    ]);

                } 
                catch (\Exception $e) 
                {
                    \Log::error("Erreur pendant l'importation: " . $image->getClientOriginalName(), [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    /*  return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Erreur lors du téléversement du fichier.' . $e->getMessage()]); */
                }
            }
        } 
        else 
        {
            return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Aucune image à importer.']);
        }

        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');
        $contactData = session('contact', []);
        $unspscData = session('UNSPSC');
        $rbqData = session('RBQ');

        try 
        {
            $fournisseur = new Fournisseur($fournisseurData);
            $fournisseur->save();

            $fournisseurCoord = new FournisseurCoord($coordonneesData);
            $fournisseurCoord->fournisseur_id = $fournisseur->id;
            $fournisseurCoord->save();

            foreach ($contactData as $contact) 
            {
                $contactNew = new Contact($contact);
                $contactNew->fournisseur_id = $fournisseur->id;
                $contactNew->save();
            }

            if (isset($unspscData['idUnspsc']) && is_array($unspscData['idUnspsc'])) 
            {
                foreach ($unspscData['idUnspsc'] as $index => $unspscId) 
                {
                    $unspsc = new Unspsccode();
                    $unspsc->fournisseur_id = $fournisseur->id;
                    $unspsc->idUnspsc = $unspscId;
                    $unspsc->details = $unspscData['details'] ?? '';
                    $unspsc->save();
                }
            }

            $rbqLicence = new RBQLicence($rbqData);
            $rbqLicence->fournisseur_id = $fournisseur->id;
            $rbqLicence->save();

            if ($request->hasFile('images')) 
            {
                foreach ($request->file('images') as $key => $image) 
                {
                    try 
                    {

                        $uniqueFileName = str_replace(' ', '_', $fournisseur->id) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                        $fileSize = $image->getSize();
                        if ($fileSize === false || $fileSize === 0) 
                        {
                            throw new \RuntimeException("Impossible de trouver la taille pour: " . $image->getClientOriginalName());
                        }

                        $image->move(public_path('images/fournisseurs'), $uniqueFileName);

                        $file = new File();
                        $file->nomFichier = $image->getClientOriginalName();
                        ;
                        $file->lienFichier = '/images/fournisseurs/' . $uniqueFileName;
                        $file->tailleFichier_KO = $fileSize;
                        $file->fournisseur_id = $fournisseur->id;
                        $file->save();

                        \Log::info("Fichiers importés avec succès: " . $uniqueFileName);
                        
                    } 
                    catch (\Exception $e) 
                    {
                        \Log::error("Erreur pendant l'importation: " . $image->getClientOriginalName(), [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        /*  return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Erreur lors du téléversement du fichier.' . $e->getMessage()]); */
                    }
                }
            }
            // !!!! Laisser en commentaire !!!  Mail::to($fournisseur->email)->send(new recevoirConfirmation($fournisseur));
            $admins = DB::table('users')->where('role', ['admin', 'responsable'])->get();
            foreach ($admins as $admin) 
            {
                if ($admin->email == 'mathys.lessard.02@edu.cegeptr.qc.ca' || $admin->email == 'simon.beaulieu.04@edu.cegeptr.qc.ca') 
                {
                    Mail::to($admin->email)->send(new demandeFournisseur());
                }
            }

            if ($fournisseur->email == 'mathys.lessard.02@edu.cegeptr.qc.ca' || $fournisseur->email == 'simon.beaulieu.04@edu.cegeptr.qc.ca') 
            {
                Mail::to($fournisseur->email)->send(new recevoirConfirmation($fournisseur));
            }

            session()->forget(['fournisseurNeq', 'fournisseur', 'coordonnees', 'contact', 'RBQ', 'UNSPSC']);  

            return redirect()->route('fournisseur.index')->with('message', 'Toutes les informations ont été enregistrées avec succès.');

        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Erreur lors de la sauvegarde des informations.' . $e->getMessage()]);
        }
    }

    public function editImportation()
    {
        $fournisseur = Auth::user();
        return view('fournisseur.editImportation', compact('fournisseur'));
    }

    public function updateImportation(Request $request)
    {
 
        if ($request->hasFile('images')) 
        {
            $maxSize = Setting::latest()->first()->tailleMax * 1024;

            foreach ($request->file('images') as $key => $image) 
            {
                try 
                {
                    $request->validate([
                        "images.{$key}" => 'required|max:' . $maxSize . '|mimes:pdf,doc,docx,jpg,jpeg,png,xlsx,xls,csv,svg',
                    ], [
                        "images.{$key}.max" => 'Le fichier est au-dessus de la limite définie',
                        "images.{$key}.required" => 'L\'image est requise',
                        "images.{$key}.mimes" => 'Le fichier doit être dans un format imprimable: JPG, PNG, DOCX, DOC, PDF, XLSX, XLS, CSV'
                    ]);

                    $uniqueFileName = str_replace(' ', '_', Auth::user()->id) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $fileSize = $image->getSize();

                    if ($fileSize === false || $fileSize === 0) 
                    {
                        throw new \RuntimeException("Impossible de trouver la taille pour: " . $image->getClientOriginalName());
                    }

                    $image->move(public_path('images/fournisseurs'), $uniqueFileName);

                    $file = new File();
                    $file->nomFichier = $image->getClientOriginalName();
                    $file->lienFichier = '/images/fournisseurs/' . $uniqueFileName;
                    $file->tailleFichier_KO = $fileSize;
                    $file->fournisseur_id = Auth::user()->id;
                    $file->save();

                    \Log::info("Fichier importé avec succès: " . $uniqueFileName);
                } 
                catch (\Exception $e) 
                {
                    \Log::error("Erreur pendant l'importation: " . $image->getClientOriginalName(), [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Erreur lors du téléversement du fichier: ' . $e->getMessage()]);
                }
            }

            return redirect()->route('fournisseur.information')->with('message', 'Fichiers importés avec succès.');
        }

            return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Aucun fichier à importer.']);
        
    }

    public function deleteFile($id)
    {
        try {
            $file = File::findOrFail($id);
            $filePath = public_path($file->lienFichier);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $file->delete();

            return redirect()->route('fournisseur.information')->with('message', 'Fichier supprimé avec succès.');
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.information')->withErrors(['error' => 'Erreur lors de la suppression du fichier.']);
        }
    }



    //Finance

    public function finances()
    {
        return View('fournisseur.finances');
    }

    public function storeFinances(FinanceRequest $request)
    {
        try {
            $fournisseur = Auth::user();
            $leFournisseur = Fournisseur::where('id', $fournisseur->id)->first();
            $finance = new Finance($request->all());
            $finance->fournisseur_id = $fournisseur->id;
            $finance->save();
            $leFournisseur->save();


            return redirect()->route('fournisseur.information')->with('message', "Enregistré!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('fournisseur.finances')->withErrors(['Informations invalides']);
        }
    }

    public function editFinances($id)
    {

        $fournisseur = Fournisseur::find(Auth::id());
        if($fournisseur == null){
            $fournisseur = Fournisseur::where('id',$id)->first();
        }
        $finances = $fournisseur->finance;

        return view('fournisseur.editFinances', compact('finances'));
    }

    public function updateFinances(FinanceRequest $request,$id)
    {
        $responsable = false;
        // Récupérer l'utilisateur authentifié
        $fournisseur = Fournisseur::find(Auth::id());
        if($fournisseur == null){
            $responsable = true;
            $fournisseur = Fournisseur::where('id',$id)->first();
        }

        $finances = $fournisseur->finance;
        $finances->fill($request->validated()); 
        $finances->save(); 
        $fournisseur->touch();

        if($responsable){
            return redirect()->route('responsable.demandeFournisseurZoom', [$fournisseur->id])->with('message', 'finance mise à jour avec succès');
        }
        else{
            return redirect()->route('fournisseur.information')->with('message', 'Licence RBQ mise à jour avec succès');
        }


    }

    /**
     * FUNCTION **** FUNCTION**** FUNCTION ****FUNCTION ****FUNCTION****FUNCTION **** FUNCTION ****FUNCTION ****
    */

    private function formatPhoneNumber($number)
    {
        return substr($number, 0, 3) . '-' . substr($number, 3, 3) . '-' . substr($number, 6);
    }

    private function formatPostalCode($code)
    {
        return substr($code, 0, 3) . ' ' . substr($code, 3);
    }
    
}
