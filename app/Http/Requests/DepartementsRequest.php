<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartementsRequest extends FormRequest
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
            'CodeD' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:255',
                Rule::unique('Departements', 'CodeD')->ignore($this->route('departement'), 'CodeD'),
            ],
            'Libelle' => ['required', 'string', 'max:40'],
        ];
    }
}
