<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandesRequest extends FormRequest
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
            'DateCmd' => ['required', 'date'],
            'Montant' => ['required', 'numeric', 'gt:0'],
            'IdClient' => ['required', 'string', 'exists:Clients,IdClient'],
        ];
    }
}
