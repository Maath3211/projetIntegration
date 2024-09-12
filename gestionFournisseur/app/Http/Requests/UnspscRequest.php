<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnspscRequest extends FormRequest
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
            'details' => 'required|max:500|min:5',
            'idUnspsc' => 'required'
        ];
    }

    public function messages(){
        return[
            'details.required' => 'Champ obligatoire',
            'details.max' => 'Details trop grand',
            'details.min' => 'Détails trop petit',
            'idUnspsc.required' => 'Dois ',
        ];
    }
}
