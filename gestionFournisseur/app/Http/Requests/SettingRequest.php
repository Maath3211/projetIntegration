<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'emailAppro' => [
                'required',
                'email'
            ],
            'emailFinance' => [
                'required',
                'email'
            ],
            'delaiRev' => [
                'required',
                'integer',
                'min:1',
                'max:24'
            ],
            'tailleMax' => [
                'required',
                'integer',
                'min:1',
                'max:100'
            ]

        ];
    }
    public function messages()
    {
        return [
            'emailAppro.required' => 'Le courriel d\'approvisionnement est requis.',
            'emailAppro.email' => 'Le courriel d\'approvisionnement doit être dans le format d\'une adresse courriel.',
            'emailFinance.required' => 'Le courriel finance est requis.',
            'emailFinance.email' => 'Le courriel finance doit être dans le format d\'une adresse courriel.',
            'delaiRev.required' => 'Le délai de révision est requis',
            'delaiRev.integer' => 'Le délai doit être un nombre non fractionné',
            'delaiRev.min' => 'Le délai ne peut pas être négatif',
            'delaiRev.max' => 'Le délai ne peut pas être supérieur à 24 mois',
            'tailleMax.required' => 'La taille maximale est requise',
            'tailleMax.integer' => 'La taille maximale doit être non fractionnée',
            'tailleMax.min' => 'La ne peut pas être négatif',
            'tailleMax.max' => 'La taille ne peut pas être supérieur à 100 mo',
            
        ];
    }
}
