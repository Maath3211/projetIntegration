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
            'neq' => ['string',
                'min:10',
                'max:10',
                'unique:fournisseurs,neq',
            ],
            'entreprise' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:7|max:12',
            
        ];
    }
    public function messages()
    {
        return
        [
            'password.min' => 'Le password doit contenir entre 7 caractères minimun',
            'password.max' => 'Le password doit contenir entre 12 caractères maximun',
            'neq.min' => 'Le neq doit contenir 10 caractères',
            'neq.max' => 'Le neq doit contenir 10 caractères',
            'neq.unique' => 'Le NEQ doit être unique.'
        ];
    }
}
