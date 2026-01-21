<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cours>
 */
class CoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $heureDebut = $this->faker->time('H:i:s');
        $heureFin = date('H:i:s', strtotime($heureDebut . ' + ' . rand(1, 4) . ' hours'));
        $debut = \Carbon\Carbon::parse($heureDebut);
        $fin = \Carbon\Carbon::parse($heureFin);

        return [
            'CodeE' => \App\Models\Enseignants::factory(),
            'CodeC' => \App\Models\Classes::factory(),
            'CodeM' => \App\Models\Matieres::factory(),
            'Type' => $this->faker->randomElement(['C', 'T', 'E']),
            'Jour' => $this->faker->date(),
            'HeureDebut' => $heureDebut,
            'HeureFin' => $heureFin,
            'Duree' => $fin->diffInHours($debut, true),
            'NbAbsent' => $this->faker->numberBetween(0, 30),
            'Valide' => $this->faker->boolean(),
        ];
    }
}
