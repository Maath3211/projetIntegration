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
            'statut' => 'required',
            'typeLicence' => 'required',
            'idCategorie' => 'required'
        ];
    }

    public function messages(){
        return[
            'licenceRBQ.required' => 'Champ obligatoire',
            'licenceRBQ.min' => 'Numéro de licence incomplètes',
            'idCategorie.required' => 'Choisir une catégorie',
        ];
    }
}
