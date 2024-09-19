<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 7 caractères.',
            'password.max' => 'Le mot de passe ne peut pas dépasser 12 caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moin une majuscules, une minuscules, un chiffre et un caractères spéciaux.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ];
    }
}
