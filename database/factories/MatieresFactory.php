<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matieres>
 */
class MatieresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CodeM' => $this->faker->unique()->bothify('MAT-###'),
            'Libelle' => $this->faker->words(3, true),
            'CodeD' => \App\Models\Departements::factory(),
            'MH' => $this->faker->randomFloat(2, 20, 60),
            'Coef' => $this->faker->randomElement(['1', '3', '5']),
        ];
    }
}
