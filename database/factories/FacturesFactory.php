<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factures>
 */
class FacturesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'DateFact' => $this->faker->dateTime(),
            'IdCde' => \App\Models\Commandes::inRandomOrder()->first()->IdCde,
        ];
    }
}
