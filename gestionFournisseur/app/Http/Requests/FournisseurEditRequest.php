<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurEditRequest extends FormRequest
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

            'entreprise' => 'required|string|max:64',
            'email' => 'required|email|max:64',
        ];
    }

    public function messages()
    {
        return [
            'entreprise.required' => 'Le nom de l\'entreprise est requis.',
            'entreprise.max' => 'Le nom de l\'entreprise ne peut pas dépasser 64 caractères.',
            'email.required' => 'L\'adresse courriel est requise.',
            'email.email' => 'L\'adresse courriel doit être une adresse valide.',
            'email.max' => 'L\'adresse courriel ne peut pas dépasser 64 caractères.',
        ];
    }
}