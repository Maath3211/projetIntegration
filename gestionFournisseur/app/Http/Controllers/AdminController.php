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

    public function impo()
    {
        return view('tmp.importationImg');
    }

    public function impoImg(Request $request)
    {
        if ($request->hasFile('images')) {
            $maxSize = Setting::latest()->first()->tailleMax * 1024;

            foreach ($request->file('images') as $key => $image) {
                try {

                    $uniqueFileName = str_replace(' ', '_', $request->user()->id) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    $request->validate([
                        "images.{$key}" => 'required|max:' . $maxSize . '|mimes:pdf,doc,docx,jpg,jpeg,png,xlsx,xls,csv',
                    ], [
                        "images.{$key}.max" => 'Le fichier est au-dessus de la limite définie',
                        "images.{$key}.required" => 'L\'image est requise',
                        "images.{$key}.mimes" => 'Le fichier doit être dans un format imprimable: JPG, PNG, DOCX, DOC, PDF, XLSX, XLS, CSV'
                    ]);

                    $fileSize = $image->getSize();
                    if ($fileSize === false || $fileSize === 0) {
                        throw new \RuntimeException("Impossible de trouver la taille pour: " . $image->getClientOriginalName());
                    }

                    $image->move(public_path('images/fournisseurs'), $uniqueFileName);

                    $file = new File();
                    $file->nomFichier = $uniqueFileName;
                    $file->lienFichier = '/images/fournisseurs/' . $uniqueFileName;
                    $file->tailleFichier_KO = $fileSize;
                    $file->save();

                    \Log::info("Fichiers importés avec succès: " . $uniqueFileName);
                } catch (\Exception $e) {
                    \Log::error("Erreur pendant l'importation: " . $image->getClientOriginalName(), [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return redirect()->route('admin.impo')->withErrors(['error' => 'Erreur lors du téléversement du fichier.' . $e->getMessage()]);
                }
            }

            return redirect()->route('admin.impo')->with('message', 'Téléversement réussi !');
        }

        return redirect()->route('admin.impo')->withErrors(['error' => 'Aucun fichier à importer.']);
    }








    public function contact()
    {
        return view('tmp.ajoutContact');
    }

    public function ajoutContact(ContactRequest $request, Contact $Request)
    {
        $contact = new contact($request->validated());
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
        } catch (\Throwable $e) {
            return redirect()->route('admin.contact')->withErrors('Erreur lors de l\'ajout du contact');
        }
    }

}
