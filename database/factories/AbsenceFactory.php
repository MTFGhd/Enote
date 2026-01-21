<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CodeE' => \App\Models\Etudiants::factory(),
            'NumC' => \App\Models\Cours::factory(),
            'Jour' => $this->faker->date(),
            'Duree' => $this->faker->randomFloat(2, 1, 4),
        ];
    }
}
