<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function setting()
    {
        return View('admin.setting');
    }

    public function update(Request $request)
    {
        if ($request->emailAppro){
            $request->validate([
                'emailAppro' => [
                    'required',
                    'email'
                ]
                ]);
        }
        else{
            $request->validate([
                'emailAppro' => [
                    'required',
                    'email'
                ]
                ],[
                    'emailAppro.required' => 'Le courriel approvisionnement est requis.',
                    'emailAppro.email' => 'Le courriel approvisionnement doit être dans le format d\'un adresse courriel.',
                ]);
        }

        if ($request->delai){
            
        }
        if ($request->maxSize){
            
        }
        if ($request->emailFinance){
            $request->validate([
                'emailFinance' => [
                    'required',
                    'email'
                ]
                ],[
                    'emailFinance.required' => 'Le courriel finance est requis.',
                    'emailFinance.email' => 'Le courriel finance doit être dans le format d\'un adresse courriel.',
                ]);
        }
        else{
            $request->validate([
                'emailFinance' => [
                    'required',
                    'email'
                ]
                ],[
                    'emailFinance.required' => 'Le courriel finance est requis.',
                    'emailFinance.email' => 'Le courriel finance doit être dans le format d\'un adresse courriel.',
                ]);
        }
        /* $compte->save(); */
        return redirect()->route('admin.parametre');
    }





}
