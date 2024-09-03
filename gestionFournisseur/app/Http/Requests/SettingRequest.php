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
        return false;
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
            ]

        ];
    }
    public function messages()
    {
        return [
            'emailAppro.required' => 'Le courriel approvisionnement est requis.',
            'emailAppro.email' => 'Le courriel approvisionnement doit être dans le format d\'un adresse courriel.',
        ];
    }
}
