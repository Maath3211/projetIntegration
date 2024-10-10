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
use App\Http\Requests\FournisseurRequest;
use App\Http\Requests\UnspscRequest;
use App\Http\Requests\RBQRequest;
use App\Http\Requests\FournisseurCoordRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\FinanceRequest;
use App\Mail\recevoirConfirmation;
use Mail;
use DB;


class PortailFournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return View('fournisseur.index');
    }

    public function infoLogin()
    {
        $fournisseur = Auth::user();
        $rbq = RBQLicence::where('fournisseur_id',$fournisseur->id)->first();
        $unspsc = Unspsccode::where('fournisseur_id',$fournisseur->id)->first();
        $contact = Contact::where('fournisseur_id',$fournisseur->id)->first();
        $coordonee = FournisseurCoord::where('fournisseur_id', $fournisseur->id)->first();
        $file = File::where('fournisseur_id', $fournisseur->id)->first();
        
        
        $categorie = Categorie::where('id', $rbq->idCategorie)->first();
        $unspscCode = UNSPSC::where('id', $unspsc->idUnspsc)->first();


        //dd($file);




        return View('fournisseur.information', compact('fournisseur','rbq','categorie','unspsc','unspscCode', 'contact', 'coordonee', 'file'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FournisseurRequest $request, Fournisseur $Request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * INSCRIPTION **** INSCRIPTION **** INSCRIPTION ****INSCRIPTION ****INSCRIPTION ****INSCRIPTION **** INSCRIPTION ****INSCRIPTION ****
     */

    //Identification

    public function inscription()
    {
        return view('fournisseur.inscription');
        //session()->forget(['fournisseurNeq','fournisseur', 'coordonnees', 'contact', 'RBQ', 'UNSPSC']);
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

        return view('fournisseur.identification', compact('neq','entrepriseNeq','emailNeq'));
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

        } else 
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
                    'codeRegion' => $request->codeRegion ?? null,
                    'nomRegion' => $request->nomRegion ?? null,
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

    // Contact

    public function contact()
    {

        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');

        if (is_null($fournisseurData) || is_null($coordonneesData)) 
        {
            return redirect()->route('fournisseur.coordonnees')->withErrors(['Les informations du fournisseur ou des coordonnées sont manquantes.']);
        }

        return view('fournisseur.ajoutContact');
    }

    public function storeContact(ContactRequest $request)
    {
        try 
        {

            session([
                'contact' => [
                    'prenom' => $request->prenom,
                    'nom' => $request->nom,
                    'fonction' => $request->fonction,
                    'courriel' => $request->courriel,
                    'typeTelephone' => $request->typeTelephone,
                    'telephone' => $request->telephone,
                    'poste' => $request->poste,
                ]
            ]);

            return redirect()->route('fournisseur.UNSPSC')->with('message', "Enregistré!");

        } catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.index')->withErrors(['Informations invalides']);
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

        $codes = Unspsc::limit(20905)->get();

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


    // Licence RBQ
    // TODO: faire la recherche neq avec la licence RBQ (Attendre les gars de la ville)

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
        return view('fournisseur.RBQ', compact('codes', 'numRBQ', 'statutRBQ', 'typeLicence', 'categorie', 'sousCategories','restriction'));
    }




    public function storeRBQ(RBQRequest $request)
    {
        try
        {
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




    // Importation
    public function importation()
    {

        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');
        $contactData = session('contact');
        $unspscData = session('UNSPSC');
        $rbqData = session('RBQ');
        $unspscData = session('UNSPSC');
    
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
                        "images.{$key}" => 'required|max:' . $maxSize . '|mimes:pdf,doc,docx,jpg,jpeg,png,xlsx,xls,csv',
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

        $fournisseurData = session('fournisseur');
        $coordonneesData = session('coordonnees');
        $contactData = session('contact');
        $unspscData = session('UNSPSC');
        $rbqData = session('RBQ');

        try 
        {
            $fournisseur = new Fournisseur($fournisseurData);
            $fournisseur->save();

            $fournisseurCoord = new FournisseurCoord($coordonneesData);
            $fournisseurCoord->fournisseur_id = $fournisseur->id;
            $fournisseurCoord->save();

            $contact = new Contact($contactData);
            $contact->fournisseur_id = $fournisseur->id;
            $contact->save();
            
            $unspsc = new Unspsccode($unspscData);
            $unspsc->fournisseur_id = $fournisseur->id;
            $unspsc->save();
            
            
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
                        $file->nomFichier = $image->getClientOriginalName();;
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

            //Mail::to($fournisseur->email)->send(new recevoirConfirmation($fournisseur));
            session()->forget(['fournisseurNeq','fournisseur', 'coordonnees', 'contact', 'RBQ', 'UNSPSC']);

            return redirect()->route('fournisseur.index')->with('message', 'Toutes les informations ont été enregistrées avec succès.');
        } 
        catch (\Throwable $e) 
        {
            Log::debug($e);
            return redirect()->route('fournisseur.importation')->withErrors(['error' => 'Erreur lors de la sauvegarde des informations.' . $e->getMessage()]);
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
            $code = new Finance($request->all());
            $code->save();
            return redirect()->route('fournisseur.finances')->with('message', "Enregistré!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('fournisseur.finances')->withErrors(['Informations invalides']);
        }
    }

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
        $reussi = Auth::attempt(['neq' => $request->neq, 'password' => $request->password]);

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

}
