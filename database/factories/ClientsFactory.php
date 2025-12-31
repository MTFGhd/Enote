<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clients>
 */
class ClientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'IdClient' => (string) Str::uuid(),
            'Nom' => $this->faker->lastName(),
            'Email' => $this->faker->unique()->safeEmail(),
            'Adresse' => $this->faker->address()
        ];
    }
}
