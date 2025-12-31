<?php

namespace App\Http\Requests;

use App\Models\Factures;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacturesRequest extends FormRequest
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
            'DateFact' => 'required|date',
            'IdCde' => [
                'required',
                'integer',
                'exists:Commandes,IdCde',
                Rule::unique('Factures', 'IdCde')->ignore($this->route('facture')?->IdFact, 'IdFact'),
            ],
        ];
    }
}
