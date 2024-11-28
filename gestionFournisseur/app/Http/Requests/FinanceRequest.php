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
            'tps' => [
                'nullable', // Autorise un champ vide
                'regex:/^\d{9}$/' // Accepte uniquement 9 chiffres si rempli
            ],
            'tvq' => [
                'nullable', // Autorise un champ vide
                'regex:/^\d{10}TQ\d{4}$/' // Valide si contient 10 chiffres, ' TQ', et 4 chiffres
            ],
            'paiement' => 'in:Aucune option de paiement,Payable immédiatement sans déduction,Payable immédiatement sans déduction. Date de base au 15 du mois suivant,Dans les 15 jours 2% escompte. dans les 30 jours sans déduction,Après entrée facture jusqu\'au 15 du mois. jusqu\'au 15 du mois suivant,Dans les 15 jours sans déduction,Dans les 30 jours sans déduction,Dans les 45 jours sans déduction,Dans les 60 jours sans déduction,',
            'devise' => 'in:CAD,USD',
            'communication' => 'in:courriel,courrier régulier',
        ];
    }


    public function messages(){
        return[
            // 'tps.required' => 'Le numéro de TPS est obligatoire.',
            'tps.regex' => 'Le numéro TPS doit être composé de 9 chiffres.',
            'tvq.regex' => 'Le numéro TVQ doit être au format "XXXXXXXXXXTQXXXX".',
            // 'tvq.required' => 'Entrer le numéro de TVQ',
            // 'paiement.required' => 'Choisir une catégorie',
            'paiement.in' => 'Ne pas changer le code source de la page',
            // 'devise.required' => 'Choisir une Devise',
            'devise.in' => 'Ne pas changer le code source de la page',
            // 'communication.required' => 'Choisir un mode de communication',
            'communication.in' => 'Ne pas changer le code source de la page',
        ];
    }
}
