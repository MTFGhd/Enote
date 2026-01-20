<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvancementRequest extends FormRequest
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
            'CodeE' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'exists:Enseignants,CodeE'
            ],
            'CodeC' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'exists:Classes,CodeC'
            ],
            'CodeM' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'exists:Matieres,CodeM'
            ],
            'MHRealise' => ['required', 'numeric', 'min:0'],
        ];
    }
}
