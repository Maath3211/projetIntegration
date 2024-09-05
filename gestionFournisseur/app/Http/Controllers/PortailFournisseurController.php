<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Fournisseur;
use App\Models\FournisseurCoord;
use App\Models\Unspsc;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\FournisseurRequest;
use App\Http\Requests\FournisseurCoordRequest;


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
        return View('fournisseur.information');
    }

    public function UNSPSC()
    {
        $codes = Unspsc::all();
        return View('fournisseur.UNSPSC', compact('codes'));
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

     public function createCoordo()
     {
         return View('fournisseur.coordonnees'); // nom de la page web 
     }
 
     public function storeCoordo(FournisseurCoordRequest $request, FournisseurCoord $Request)
     {
        {
            try
            {
                $fournisseurCoord = new FournisseurCoord($request->all());
                $fournisseurCoord['noCivic'] = ($request->noCivic);
                $fournisseurCoord['rue'] = ($request->rue);
                $fournisseurCoord['bureau'] = ($request->bureau);
                $fournisseurCoord['ville'] = ($request->ville);
                $fournisseurCoord['province'] = ($request->province);
                $fournisseurCoord['codePostal'] = ($request->codePostal);
                /*$fournisseurCoord['codeRegion'] = ($request->password);*/
                /*$fournisseurCoord['nomRegion'] = ($request->password);*/
                $fournisseurCoord['site'] = ($request->site);
                $fournisseurCoord['typeTel'] = ($request->typeTel);
                $fournisseurCoord['numero'] = ($request->numero);
                $fournisseurCoord['poste'] = ($request->poste);
                $fournisseurCoord->save();
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

    public function createIden()
    {
        return view('fournisseur.inscriptionIden');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeIden(FournisseurRequest $request, Fournisseur $Request)
    {
        {
            try
            {
                $fournisseurIden = new Fournisseur($request->all());
                $fournisseurIden['neq'] = ($request->neq);
                $fournisseurIden['entreprise'] = ucfirst($request->entreprise);
                $fournisseurIden['email'] = ($request->email);
                $fournisseurIden['password'] = ($request->password);
                
                $fournisseurIden->save();
                return redirect()->route('fournisseur.index')->with('message',"Bienvenue!");
            }
            catch (\Throwable $e)
            {
                 Log::debug($e);
                 return redirect()->route('fournisseur.inscriptionIden')->withErrors(['Informations invalides']); 
            }

            return redirect()->route('fournisseur.index');
            }
    }

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

}
