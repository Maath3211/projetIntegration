<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Fournisseur;
use App\Models\FournisseurCoord;
use App\Models\Unspsc;
use App\Models\Unspsccode;
use App\Models\RBQLicence;
use App\Models\Categorie;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\FournisseurRequest;
use App\Http\Requests\FournisseurCoordRequest;
use App\Http\Requests\UnspscRequest;
use App\Http\Requests\RBQRequest;




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
        return View('fournisseur.information', compact('fournisseur'));
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
    public function createIdentification()
    {
        return view('fournisseur.identification');
    }

    /**
     * INSCRIPTION **** INSCRIPTION **** INSCRIPTION ****INSCRIPTION ****INSCRIPTION ****INSCRIPTION **** INSCRIPTION ****INSCRIPTION ****
     */
    public function storeIdentification(FournisseurRequest $request, Fournisseur $Request)
    {
        {
            try
            {
                $fournisseurIden = new Fournisseur($request->validated());
                $fournisseurIden['neq'] = ($request->neq);
                $fournisseurIden['entreprise'] = ($request->entreprise);
                $fournisseurIden['email'] = ($request->email);
                $fournisseurIden['password'] = ($request->password);
                
                $fournisseurIden->save();
                return redirect()->route('fournisseur.index')->with('message',"Bienvenue!");
            }
            catch (\Throwable $e)
            {
                 Log::debug($e);
                 return redirect()->route('fournisseur.identification')->withErrors(['Informations invalides']); 
            }

            return redirect()->route('fournisseur.index');
            }
    }

    public function createCoordo()
    {
       $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22');

       if ($response->successful()) {
           $villes = collect($response->json()['result']['records'])->pluck('munnom')->all();

       } else {
           $villes = [];
       }

       return view('fournisseur.coordonnees', compact('villes')); 
    }

    public function storeCoordo(FournisseurCoordRequest $request, FournisseurCoord $Request)
    {
       {
           try
           {
               $nomRegion = "";
               $codeRegion = "";
               $villeChoisie = $request->input('ville');
               $provinceChoisie = $request->input('province');

               if ($provinceChoisie === 'Québec') {
               $response = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT%20%22munnom%22,%20%22regadm%22%20FROM%20%2219385b4e-5503-4330-9e59-f998f5918363%22%20WHERE%20%22munnom%22=%27' . urlencode($villeChoisie) . '%27');
                   if ($response->successful() && count($response->json()['result']['records']) > 0) {
                       $regionTrouve = $response->json()['result']['records'][0]['regadm'];

                       if (!empty($regionTrouve)) {
                           $nomRegion = rtrim(strtok($regionTrouve, '('));
                           $codeRegion = trim(strtok('()')); 
                   }
               }
           }

               $fournisseurCoord = new FournisseurCoord($request->validated());
               $fournisseurCoord['noCivic'] = ($request->noCivic);
               $fournisseurCoord['rue'] = ($request->rue);
               $fournisseurCoord['bureau'] = ($request->bureau);
               $fournisseurCoord['ville'] = ucfirst($request->ville);
               $fournisseurCoord['province'] = ($request->province);
               $fournisseurCoord['codePostal'] = strtoupper($request->codePostal);
               $fournisseurCoord['codeRegion'] = ($codeRegion);
               $fournisseurCoord['nomRegion'] = ($nomRegion);
               $fournisseurCoord['site'] = ($request->site);
               $fournisseurCoord['typeTel'] = ($request->typeTel);
               $fournisseurCoord['numero'] = ($request->numero);
               $fournisseurCoord['poste'] = ($request->poste);
               $fournisseurCoord['typeTel2'] = ($request->typeTel2);
               $fournisseurCoord['numero2'] = ($request->numero2);
               $fournisseurCoord['poste2'] = ($request->poste2);
               $fournisseurCoord->save();

               // dd($fournisseurCoord->toArray()); 

               return redirect()->route('fournisseur.index')->with('message',"Enregistré!");
           }
           catch (\Throwable $e)
           {
                Log::debug($e);
                return redirect()->route('fournisseur.coordonnees')->withErrors(['Informations invalides']); 
           }

           return redirect()->route('fournisseur.index');
           }
   }


    // Code Unspsc 
    
    public function UNSPSC()
    {
        $codes = Unspsc::all();
        return View('fournisseur.UNSPSC', compact('codes'));
    }

    public function storeUnspsc(UnspscRequest $request)
    {
        try{
            $code = new Unspsccode($request->all());
            $code->save();
            
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('fournisseur.index');
        }
        return redirect()->route('fournisseur.UNSPSC');
        
    }

    // Licence RBQ
    // TODO: faire la recherche neq avec la licence RBQ (Attendre les gars de la ville)
    public function RBQ()
    {


        $codes = Categorie::all();
        return View('fournisseur.RBQ', compact('codes'));
    }


    public function storeRBQ(RBQRequest $request)
    {
        try{
            $code = new RBQLicence($request->all());
            $code->save();
            
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('fournisseur.RBQ');
        }
        return redirect()->route('fournisseur.UNSPSC');
        
    }

    //Finance


    public function finances()
    {

        return View('fournisseur.finances');
    }


        /**
     * CONNEXION **** CONNEXION **** CONNEXION ****CONNEXION ****CONNEXION****CONNEXION **** CONNEXION ****CONNEXION ****
     */

    public function loginEmail(ConnexionRequest $request)
    {
        $reussi = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($reussi){
            $fournisseurEmail = Fournisseur::where('email', $request->email)->firstOrFail();
            return redirect()->route('fournisseur.information');
        }
        else{
            return redirect()->route('fournisseur.index')->withErrors(['Informations invalides']); 
        }
    }

    public function loginNeq(ConnexionRequest $request)
    {
        $reussi = Auth::attempt(['neq' => $request->neq, 'password' => $request->password]);
        if($reussi){
            $fournisseurNeq = Fournisseur::where('neq', $request->neq)->firstOrFail();
            return redirect()->route('fournisseur.information');
        }
        else{
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
