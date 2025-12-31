<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commandes;
use App\Models\Factures;
use Illuminate\Support\Carbon;

class FacturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have commandes first
        if (Commandes::query()->count() === 0) {
            $this->call(CommandesSeeder::class);
        }

        // One facture per commande (keeps hasOne relation consistent)
        $commandes = Commandes::query()->get(['IdCde', 'DateCmd']);

        foreach ($commandes as $commande) {
            $alreadyBilled = Factures::query()->where('IdCde', $commande->IdCde)->exists();
            if ($alreadyBilled) {
                continue;
            }

            $dateCmd = Carbon::parse($commande->DateCmd);
            $dateFact = $dateCmd->copy()->addDays(random_int(0, 30));

            Factures::query()->create([
                'IdCde' => $commande->IdCde,
                'DateFact' => $dateFact,
            ]);
        }
    }
}
