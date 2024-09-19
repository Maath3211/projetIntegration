<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceRequest extends FormRequest
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
            'tps' => 'required',
            'tvq' => 'required',
            'paiement' => 'required',
            'devise' => 'required',
            'communication' => 'required',
        ];
    }


    public function messages(){
        return[
            'tps.required' => 'Entrer le numéro de TPS',
            'tvq.required' => 'Entrer le numéro de TVQ',
            'paiement.required' => 'Choisir une catégorie',
            'devise.required' => 'Choisir une Devise',
            'communication.required' => 'Choisir un mode de communication',
        ];
    }
}
