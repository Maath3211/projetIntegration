<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnspscRequest extends FormRequest
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
            'details' => 'max:500',
            'idUnspsc' => 'required|array|min:1', 
            /*'idUnspsc.*' => 'integer|exists:unspsccodes,id',*/
        ];
    }

    public function messages(){
        return[
            'details.max' => 'Détails trop grands',
            'idUnspsc.required' => 'Aucun code Unspsc sélectionné',
            'idUnspsc.array' => 'Sélection invalide',
            'idUnspsc.min' => 'Sélectionnez au moins un code',
        ];
    }
}
