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
            'paiement' => 'required|in:Payable immédiatement sans déduction,Payable immédiatement sans déduction. Date de base au 15 du mois suivant,Dans les 15 jours 2% escompte. dans les 30 jours sans déduction,Après entrée facture jusquau 15 du mois. jusquau 15 du mois suivant...,Dans les 15 jours sans déduction,Dans les 30 jours sans déduction,Dans les 45 jours sans déduction,Dans les 60 jours sans déduction,',
            'devise' => 'required|in:CAD,USD',
            'communication' => 'required|courriel,courrielRegulier',
        ];
    }


    public function messages(){
        return[
            'tps.required' => 'Entrer le numéro de TPS',
            'tvq.required' => 'Entrer le numéro de TVQ',
            'paiement.required' => 'Choisir une catégorie',
            'paiement.in' => 'Ne pas changer le code source de la page',
            'devise.required' => 'Choisir une Devise',
            'devise.in' => 'Ne pas changer le code source de la page',
            'communication.required' => 'Choisir un mode de communication',
            'communication.in' => 'Ne pas changer le code source de la page',
        ];
    }
}
