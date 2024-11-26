<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        //TODO: limiter dans bd
        return [
            'prenom' => [
                'required',
                'max:32',
                'regex:/^[a-zA-ZÀ-ÿ\'\-]+$/u'
            ],
            'nom' => [
                'required',
                'max:32',
                'regex:/^[a-zA-ZÀ-ÿ\'\-]+$/u'
            ],
            'fonction' => [
                'required',
                'max:32',
                'regex:/^[a-zA-ZÀ-ÿ\s!@#$%^&*(),.?":{}|<>]+$/u'
            ],
            'courriel' => [
                'required',
                'email',
                'max:64'
            ],
            'typeTelephone' => [
                'required',
                'in:Bureau,Telecopieur,Cellulaire'
                
            ],
            'telephone' => [
                'required',
                'digits:10'
            ],
            'poste' => [
                'nullable',
                'numeric',
                'between:0,999999'
            ]
        ];
    }
    public function messages()
    {
        return [
            'prenom.required' => 'Le prénom est requis.',
            'prenom.max' => 'Le nombre de caractères maximal pour le prénom est 32',
            'prenom.regex' => 'Les seuls caractères acceptés pour le prénom sont: les lettres, les apostrophes et les tirets',

            'nom.required' => 'Le nom est requis.',
            'nom.max' => 'Le nombre de caractères maximal pour le nom est 32',
            'nom.regex' => 'Les seuls caractères acceptés pour le nom sont: les lettres, les apostrophes et les tirets',

            'fonction.required' => 'La fonction est requise.',
            'fonction.max' => 'Le nombre de caractères maximal est 32',
            'fonction.regex' => 'Les seuls caractères acceptés pour l\'adresse courriel sont: les lettres et les caractères spéciaux',

            'courriel.required' => 'Le courriel est requis.',
            'courriel.email' => 'Le courriel doit doit avoir le format xxxx@xxxx.xxx',
            'courriel.max' => 'Le nombre de caractères maximal pour le courriel est 64',

            'typeTelephone.required' => 'Le type de téléphone est requis.',
            'typeTelephone.in' => 'Le type de téléphone doit être Bureau, Télécopieur ou cellulaire.',
            
            'telephone.required' => 'Le numéro de téléphone est requis',
            'telephone.digits' => 'Le numéro de téléphone doit avoir 10 chiffres',

            'poste.numeric' => 'Le poste doit être numérique',
            'poste.between' => 'Le poste ne peut pas contenir plus de 6 chiffres',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'telephone' => str_replace('-', '', $this->input('telephone', '')),
        ]);
    }
}
