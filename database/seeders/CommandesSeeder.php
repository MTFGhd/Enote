<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clients;
use App\Models\Commandes;

class CommandesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Clients::query()->count() === 0) {
            Clients::factory()->count(10)->create();
        }

        // Create a realistic number of orders per client
        foreach (Clients::query()->get() as $client) {
            $count = random_int(1, 5);
            Commandes::factory()
                ->count($count)
                ->create(['IdClient' => $client->IdClient]);
        }
    }
}
