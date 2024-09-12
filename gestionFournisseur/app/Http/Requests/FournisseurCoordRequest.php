<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurCoordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'noCivic' => 'required|max:8|alpha_num',
            'rue' => 'required|string|max:64',
            'bureau' => 'nullable|string|max:8|alpha_num', 
            'ville' => 'required|string|max:64',
            'province' => 'required|in:Alberta,Colombie-Britannique,Île-du-prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Écosse,Ontario,Québec,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon',
            'codePostal' => ['required', 'string', 'regex:/^(?!.*[DFIOQU])[A-VXY][0-9][A-Z] ?[0-9][A-Z][0-9]$/i'], // inclusion du i pour insensible à la case
            //'codeRegion' => 'nullable|string|size:2', Ne devrait pas contenir d'erreur via l'API
            //'nomRegion' => 'nullable|string',         Ne devrait pas contenir d'erreur via l'API
            'site' => 'nullable|string|max:64|url',
            'typeTel' => 'required|in:Bureau,Télécopieur,Cellulaire', 
            'numero' => 'required|digits:10', 
            'poste' => 'nullable|numeric|between:1,999999',
            'typeTel2' => 'nullable', 
            'numero2' => 'nullable|digits:10',   
            'poste2' => 'nullable|numeric|between:1,999999',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'numero' => str_replace('-', '', $this->input('numero', '')),
            'numero2' => str_replace('-', '', $this->input('numero2', '')),
        ]);
    }
    
    public function messages()
    {
        return [
            'noCivic.required' => 'Le numéro civique est requis.',
            'noCivic.max' => 'Le numéro civique ne peut pas dépasser 8 caractères.',
            'noCivic.alpha_num' => 'Le numéro civique doit être alphanumérique.',
            'rue.required' => 'La rue est requise.',
            'rue.max' => 'La rue ne peut pas dépasser 64 caractères.',
            'bureau.max' => 'Le numéro de bureau ne peut pas dépasser 8 caractères.',
            'bureau.alpha_num' => 'Le numéro de bureau doit être alphanumérique.',
            'ville.required' => 'La ville est requise.',
            'ville.max' => 'La ville ne peut pas dépasser 64 caractères.',
            'province.required' => 'La province est requise.',
            'province.in' => 'Choix : Alberta,Colombie-Britannique,Île-du-prince-Édouard,Manitoba,Nouveau-Brunswick,Nouvelle-Écosse,Ontario,Québec,Saskatchewan,Terre-Neuve-et-Labrador,Territoires du Nord-Ouest,Nunavut,Yukon',
            'codePostal.required' => 'Le code postal est requis.',
            'codePostal.regex' => 'Le code postal doit être un code postal canadien valide.',
            'codeRegion.size' => 'Le code de région doit être exactement de 2 caractères.',
            'codeRegion.numeric' => 'Le code de région doit être numérique.',
            'site.max' => 'L\'adresse du site web ne peut pas dépasser 64 caractères.',
            'site.url' => 'L\'adresse du site web doit être une URL valide. EX: https://www.v3r.net',
            'typeTel.in' => 'Choix : Bureau, Télécopieur et Cellulaire',
            'numero.required' => 'Le champ numéro de téléphone est obligatoire.',
            'numero.digits' => 'Le champ numéro de téléphone doit contenir exactement 10 chiffres.',
            'poste.between' => 'Le numéro de poste ne peut pas dépasser 6 caractères.',
            'poste.numeric' => 'Le numéro de poste doit être numérique.',
            'typeTel2.in' => 'Choix : Bureau, Télécopieur et Cellulaire',
            'numero2.digits' => 'Le champ numéro de téléphone doit contenir exactement 10 chiffres.',
            'poste2.between' => 'Le numéro de poste ne peut pas dépasser 6 caractères.',
            'poste2.numeric' => 'Le numéro de poste doit être numérique.',
        ];
    }
}