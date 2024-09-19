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
            'licenceRBQ' => 'required|min:10',
            'statut' => 'required|in:Valide,Valide avec restriction,Non valide',
            'typeLicence' => 'required|in:Entrepreneur,Constructeur-Propriétaire',
            'idCategorie' => 'required'
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'licenceRBQ' => str_replace('-', '', $this->input('licenceRBQ', '')),
        ]);
    }

    public function messages(){
        return[
            'licenceRBQ.required' => 'Il manque un numéro de licence',
            'licenceRBQ.min' => 'Numéro de licence incomplète',
            'idCategorie.required' => 'Choisir une catégorie',
        ];
    }
}
