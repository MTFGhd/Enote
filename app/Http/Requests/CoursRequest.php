<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursRequest extends FormRequest
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
            'CodeE' => ['required', 'string', 'exists:Enseignants,CodeE'],
            'CodeC' => ['required', 'string', 'exists:Classes,CodeC'],
            'CodeM' => ['required', 'string', 'exists:Matieres,CodeM'],
            'Type' => ['required', 'in:C,T,E'],
            'Jour' => ['required', 'date'],
            'HeureDebut' => ['required', 'date_format:H:i'],
            'HeureFin' => ['required', 'date_format:H:i', 'after:HeureDebut'],
            'Duree' => ['required', 'numeric', 'min:0'],
            'NbAbsent' => ['nullable', 'integer', 'min:0'],
            'absents' => ['nullable', 'array'],
            'absents.*' => ['exists:Etudiants,CodeE'],
        ];
    }
}
