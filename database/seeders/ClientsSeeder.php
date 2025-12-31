<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clients;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clients::factory()->count(20)->create();
    }
}
