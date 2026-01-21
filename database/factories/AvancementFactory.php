<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avancement>
 */
class AvancementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CodeE' => \App\Models\Enseignants::factory(),
            'CodeC' => \App\Models\Classes::factory(),
            'CodeM' => \App\Models\Matieres::factory(),
            'MHRealise' => $this->faker->randomFloat(2, 0, 50),
        ];
    }
}
