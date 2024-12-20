<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnexionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => [
                'required_without:neq',
                'email',
            ],
            'neq' => [
                'required_without:email',
                'string',
                'min:10',
                'max:10',
            ],
            'password' => 'required|min:7|max:12',
        ];
    }
    public function messages()
    {
        return
        [
            'password.min' => 'Le password doit contenir 7 caractères minimum',
            'password.max' => 'Le password doit contenir 12 caractères maximum',
            'neq.min' => 'Le neq doit contenir 10 caractères',
            'neq.max' => 'Le neq doit contenir 10 caractères'
        ];
    }
}
