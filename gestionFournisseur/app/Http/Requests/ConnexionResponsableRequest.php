<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnexionResponsableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:responsables,email',
            'role' => 'required|in:Commis,Responsable,Administrateur'
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Le courriel n\'existe pas dans nos enregistrements.',
            'role.in' => 'Le rôle sélectionné n\'est pas valide.',
        ];
    }
}
