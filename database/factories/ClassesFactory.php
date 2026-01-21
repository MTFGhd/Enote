<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CodeC' => $this->faker->unique()->bothify('CLS-###'),
            'CodeD' => \App\Models\Departements::factory(),
            'Libelle' => $this->faker->words(2, true),
        ];
    }
}
