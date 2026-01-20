<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === "admin";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod("PUT") || $this->isMethod("PATCH");
        $userId = $this->route("user")?->id;

        return [
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "email",
                "max:255",
                Rule::unique("users", "email")->ignore($userId),
            ],
            "role" => ["required", Rule::in(["admin", "E", "D"])],
            "CodeE" => [
                "nullable",
                "string",
                "required_if:role,E",
                Rule::exists("Enseignants", "CodeE"),
            ],
            "password" => [
                $isUpdate ? "nullable" : "required",
                "string",
                "min:8",
                "confirmed",
            ],
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "email.unique" => "Cet email est déjà utilisé.",
            "role.in" => "Le rôle sélectionné est invalide.",
            "CodeE.exists" => "Le code enseignant fourni est introuvable.",
            "CodeE.required_if" =>
                "Le code enseignant est requis pour le rôle Enseignant.",
            "password.confirmed" =>
                "La confirmation du mot de passe ne correspond pas.",
        ];
    }
}
