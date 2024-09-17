<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Setting;
use App\Models\File;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use Log;


class AdminController extends Controller
{
    public function setting()
    {
        $settings = Setting::latest()->first();
        return View('admin.setting', compact('settings'));
    }

    public function update(SettingRequest $request)
    {
        try {
        }
        catch(\Throwable $e){

        }
        $setting = new setting($request->validated());
        $setting->emailAppro = $request->emailAppro;
        $setting->delaiRev = $request->delaiRev;
        $setting->tailleMax = $request->tailleMax;
        $setting->emailFinance = $request->emailFinance;
        $setting->save();

        return redirect()->route('admin.setting');
    }

    public function impo()
    {
        return view('tmp.importationImg');
    }

    public function impoImg(Request $request)
    {
        if ($request->hasFile('image')) {
            $maxSize = Setting::latest()->first()->tailleMax;
            $maxSize = $maxSize * 1024;
            $uploadedFile = $request->file('image');
            $uniqueFileName = str_replace('  ', '_', '1'/* $compte->id */) . '-' . uniqid() . '.' . $uploadedFile->extension();
            $file = new File();
            $file->nomFichier = $uniqueFileName;
            $file->lienFichier = '/images/fournisseurs/' . $uniqueFileName;
            $file->tailleFichier_KO = $uploadedFile->getSize();


            $request->validate([
                'image' => 'required|max:' . $maxSize . '|extensions:pdf,doc,docx,jpg,jpeg,png,xlsx,xls,csv',
            ], [
                'image.max' => 'Le fichier est au dessus de la limite définie',
                'image.required' => 'L\'image est requise',
                'image.extensions' => 'Le fichier doit être dans un format imprimable: JPG, PNG, DOCX, DOC, PDF, XLSX, XLS, CSV'
            ]);

            try {
                $request->image->move(public_path('images/fournisseurs'), $uniqueFileName);
                /* File::delete(public_path() . $compte->image); */
                $file->save();

            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {
                Log::error("Erreur lors du téléversement du fichier.", [$e]);
            }
            /* $compte->image = $uniqueFileName; */
            return redirect()->route('admin.impo')->with('message', 'Téléversement réussi');
            ;
        }
        return redirect()->route('admin.impo')->withErrors(['error' => 'Erreur lors du téléversement du fichier.']);

    }






    public function contact()
    {
        return view('tmp.ajoutContact');
    }

    public function ajoutContact(/* ContactRequest $request */ Request $request)
    {
        $contact = new contact(/* $request->validated() */);//
            $contact['prenom'] = $request->prenom;
            $contact['nom'] = $request->nom;
            $contact['fonction'] = $request->fonction;
            $contact['courriel'] = $request->courriel;
            $contact['typeTelephone'] = $request->typeTelephone;
            $contact['telephone'] = $request->telephone;
            $contact['poste'] = $request->poste;
            $contact['fournisseur'] = $request->user()->id;
            
            $contact->save();
        try {
            
            
            return redirect()->route('admin.contact')->with('message', 'Contact ajouté avec succès');
        }
        catch(\Throwable $e){
            return redirect()->route('admin.contact')->withErrors('Erreur lors de l\'ajout du contact');
        }
    }

}
