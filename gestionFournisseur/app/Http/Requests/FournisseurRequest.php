<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurRequest extends FormRequest
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
            'neq' => [
                'required', // ou nullable si possède pas de NEQ
                'string',
                'size:10',
                'regex:/^(11|22|33|88)[4-9]\d{7}$/', 
                'unique:fournisseurs,neq',
            ],
            'entreprise' => 'required|string|max:64',
            'email' => 'required|email|max:64',
            'password' => [
                'required',
                'string',
                'min:7',
                'max:12',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
                'confirmed'
            ],
        ];
    }

    public function messages()
    {
        return [
            'neq.size' => 'Le NEQ doit contenir exactement 10 caractères.',
            'neq.regex' => 'Le NEQ doit commencer par 11, 22, 33, ou 88 et le troisième caractère doit être entre 4 et 9.',
            'neq.unique' => 'Le NEQ doit être unique.',
            'entreprise.required' => 'Le nom de l\'entreprise est requis.',
            'entreprise.max' => 'Le nom de l\'entreprise ne peut pas dépasser 64 caractères.',
            'email.required' => 'L\'adresse courriel est requise.',
            'email.email' => 'L\'adresse courriel doit être une adresse valide.',
            'email.max' => 'L\'adresse courriel ne peut pas dépasser 64 caractères.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 7 caractères.',
            'password.max' => 'Le mot de passe ne peut pas dépasser 12 caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moin une majuscules, une minuscules, un chiffre et un caractères spéciaux',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ];
    }
}