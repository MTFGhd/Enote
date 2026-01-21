<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departements>
 */
class DepartementsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CodeD' => $this->faker->unique()->bothify('DEP-###'),
            'Libelle' => $this->faker->words(2, true),
        ];
    }
}
