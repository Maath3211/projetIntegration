<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use Termwind\Components\Dd;


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
            $nomFichierUnique = '/images/fournisseurs/' . str_replace('  ', '_', '1'/* $compte->id */) . '-' . uniqid() . '.' . $uploadedFile->extension();

            $request->validate([
                'image' => 'required|image|max:' . $maxSize,
            ], [
                'image.max' => 'Le fichier est au dessus de la limite définie',
                'image.required' => 'L\'image est requise'
            ]);

            try {
                $request->image->move(public_path('images/fournisseurs'), $nomFichierUnique);
                /* File::delete(public_path() . $compte->image); */

            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {
                Log::error("Erreur lors du téléversement du fichier.", [$e]);
            }
            /* $compte->image = $nomFichierUnique; */
            return redirect()->route('admin.impo')->with('message', 'Téléversement réussi');
            ;
        }
        return redirect()->route('admin.impo')->withErrors(['error' => 'Erreur lors du téléversement du fichier.']);

    }



}
