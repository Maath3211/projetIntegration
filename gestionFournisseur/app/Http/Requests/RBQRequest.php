<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RBQRequest extends FormRequest
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
            'licenceRBQ' => 'required|min:12',
            'statut' => 'required|in:Valid,Valide avec restriction,Non valide',
            'typeLicence' => 'required|in:Entrepreneur,Constructeur-Propriétaire',
            'idCategorie' => 'required'
        ];
    }

    public function messages(){
        return[
            'licenceRBQ.required' => 'Il manque un numéro de licence',
            'licenceRBQ.min' => 'Numéro de licence incomplètes',
            'idCategorie.required' => 'Choisir une catégorie',
        ];
    }
}
