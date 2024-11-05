<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponsableRequest extends FormRequest
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
           
            'email' => 'required|email|max:64|unique:responsables,email',
            'role' => 'required|in:Commis,Responsable,Gestionnaire',
        ];
    }

    public function messages()
    {
        return [
            'role.in' => 'Le role doit être Commis, Responsable ou Gestionnaire.',
            'email.required' => 'L\'adresse courriel est requise.',
            'email.email' => 'L\'adresse courriel doit être une adresse valide.',
            'email.max' => 'L\'adresse courriel ne peut pas dépasser 64 caractères.',
            'email.unique' => 'L\'adresse courriel est déja utilisé.'
        ];
    }
}
