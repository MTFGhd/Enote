<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiants>
 */
class EtudiantsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CodeE' => $this->faker->unique()->bothify('ETU-###'),
            'Nom' => $this->faker->lastName(),
            'Prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'CodeC' => \App\Models\Classes::factory(),
        ];
    }
}
