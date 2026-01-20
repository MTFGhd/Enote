<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassesRequest extends FormRequest
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
            'CodeC' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:10',
                Rule::unique('Classes', 'CodeC')->ignore($this->route('class'), 'CodeC'),
            ],
            'Libelle' => ['required', 'string', 'max:40'],
            'CodeD' => ['required', 'string', 'exists:Departements,CodeD'],
        ];
    }
}
