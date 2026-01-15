<?php

namespace App\Http\Requests;

use App\Models\Clients;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientsRequest extends FormRequest
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
        /** @var Clients|null $client */
        $client = $this->route('client');

        return [
            'Nom' => ['required', 'string', 'min:2', 'max:255'],
            'Email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('Clients', 'Email')->ignore($client?->IdClient, 'IdClient'),
            ],
            'Adresse' => ['required', 'string', 'min:10', 'max:255'],
        ];
    }
}
