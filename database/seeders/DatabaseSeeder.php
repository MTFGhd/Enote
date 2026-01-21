<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
        ]);

        $departements = \App\Models\Departements::factory(10)->create();
        $enseignants = \App\Models\Enseignants::factory(10)->create();
        $matieres = \App\Models\Matieres::factory(10)->create([
            'CodeD' => fn() => $departements->random()->CodeD
        ]);
        $classes = \App\Models\Classes::factory(10)->create([
            'CodeD' => fn() => $departements->random()->CodeD
        ]);
        $etudiants = \App\Models\Etudiants::factory(10)->create([
            'CodeC' => fn() => $classes->random()->CodeC
        ]);
        $cours = \App\Models\Cours::factory(10)->create([
            'CodeE' => fn() => $enseignants->random()->CodeE,
            'CodeC' => fn() => $classes->random()->CodeC,
            'CodeM' => fn() => $matieres->random()->CodeM,
        ]);
        
        // For composite keys, we need to be careful with uniqueness. 
        // We'll just create 10 and hope faker unique helps or just use factory defaults.
        \App\Models\Avancement::factory(10)->create([
            'CodeE' => fn() => $enseignants->random()->CodeE,
            'CodeC' => fn() => $classes->random()->CodeC,
            'CodeM' => fn() => $matieres->random()->CodeM,
        ]);

        \App\Models\Absence::factory(10)->create([
            'CodeE' => fn() => $etudiants->random()->CodeE,
            'NumC' => fn() => $cours->random()->NumC,
        ]);
    }
}
