<?php

namespace App\Http\Controllers;

use App\Mail\demandeFournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use App\Models\Fournisseur;
use App\Models\User;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use Carbon\Carbon;
use Mail;
use Str;
use DB;


class AdminController extends Controller
{

    // RESPONSABLE --- RESPONSABLE --- RESPONSABLE --- RESPONSABLE --- RESPONSABLE --- RESPONSABLE

    public function index()
    {
        return View('responsable.index');
    }

    public function listeFournisseur()
    {
        return View('responsable.listeFournisseur');
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
        $fn = new Fournisseur();

        $fn->email = 'a@a.com';
        $fn->neq = '8888888888';
        $fn->entreprise = 'bor';
        $fn->statut = 'attente';
        $fn->password = 'adminggg';

        $fn->save();

        $admins = DB::table('users')->where('role', ['admin','responsable'])->get();
        
        foreach( $admins as $admin){
            Mail::to($admin->email)->send(new demandeFournisseur());
        }
    }

    public function demandeFournisseurView(){

        $fnAttentes = DB::table('fournisseurs')->where('statut', 'attente')->get();
        return view('admin.demandeFournisseur', compact('fnAttentes'));
    }

    public function demandeFournisseurZoom($neq){
        $fn = DB::table('fournisseurs')->where('neq', $neq)->first();
        $contacts = DB::table('contact')->where('fournisseur_id', $fn->id)->get();
        $coord = DB::table('coordonnees')->where('fournisseur_id', $fn->id)->get()->firstOrFail();
        $fn->dateStatut = Carbon::parse($fn->dateStatut)->toDateString();
        $fn->created_at = Carbon::parse($fn->created_at)->toDateString();
        $fn->updated_at = Carbon::parse($fn->updated_at)->toDateString();

       
        return view('admin.zoomDemandeFournisseur', compact('fn', 'contacts','coord'));
    }


}
