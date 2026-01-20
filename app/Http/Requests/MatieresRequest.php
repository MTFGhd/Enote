<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MatieresRequest extends FormRequest
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
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        
        return [
            'CodeM' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:10',
                Rule::unique('Matieres', 'CodeM')->ignore($this->route('matiere'), 'CodeM'),
            ],
            'Libelle' => ['required', 'string', 'max:40'],
            'MH' => ['required', 'numeric', 'min:0'],
            'Coef' => ['required', 'in:1,3,5'],
            'CodeD' => ['required', 'string', 'exists:Departements,CodeD'],
        ];
    }
}
