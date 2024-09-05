<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurCoordRequest extends FormRequest
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
            'noCivic' => 'required|max:8',
            'rue' => 'required|max:64',
            'bureau' => 'max:8',
            'ville' => 'required|max:64',
            'province' => 'required|max:64',
            'codePostal' => 'required|max:6',
            /*'codeRegion' => 'min2|max:2',*/
            /*'nomRegion' => '',*/
            'site' => '',
            'typeTel' => '',
            'numero' => 'max:10',
            'poste' => 'max:6',
            
        ];
    }
    public function messages()
    {
        return
        [

        ];
    }
}
