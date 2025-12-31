<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commandes>
 */
class CommandesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'DateCmd' => $this->faker->dateTime(),
            'Montant' => $this->faker->randomFloat(2, 1, 10000),
            'IdClient' => \App\Models\Clients::inRandomOrder()->first()->IdClient,
        ];
    }
}
