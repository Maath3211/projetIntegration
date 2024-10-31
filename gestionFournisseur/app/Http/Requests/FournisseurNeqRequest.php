<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurNeqRequest extends FormRequest
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
                'required', 
                'string',
                'size:10',
                'regex:/^(11|22|33|88)\d{8}$/', 
                'unique:fournisseurs,neq',
            ]
        ];
    }

    public function messages()
    {
        return [
            'neq.size' => 'Le NEQ doit contenir exactement 10 caractères.',
            'neq.regex' => 'Le NEQ doit commencer par 11, 22, 33, ou 88',
            'neq.unique' => 'Le NEQ doit être unique.',
        ];
    }
}