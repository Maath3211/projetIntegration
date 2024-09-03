<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Fournisseur;
use App\Http\Requests\ConnexionRequest;


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
        return View('fournisseur.UNSPSC');
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
    public function destroy(string $id)
    {
        //
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
