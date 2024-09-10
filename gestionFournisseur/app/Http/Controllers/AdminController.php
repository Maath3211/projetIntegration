<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;


class AdminController extends Controller
{
    public function setting()
    {
        $settings = Setting::latest()->first();
        return View('admin.setting', compact('settings'));
    }

    public function update(SettingRequest $request, Setting $Request)
    {
        $setting = new setting();
        $setting->emailAppro = $request->emailAppro;
        $setting->delaiRev = $request->delaiRev;
        $setting->tailleMax = $request->tailleMax;
        $setting->emailFinance = $request->emailFinance;
        $setting->save();

        return redirect()->route('admin.setting');
    }

    public function impo()
    {
        return view('importationImg');
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



}
