<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Commandes', function (Blueprint $table) {
            $table->id('IdCde');
            $table->dateTime('DateCmd');
            $table->decimal('Montant', 13, 2);
            $table->string('IdClient');

    // ____________ Les Contraintes _______________
            $table->primary('IdCde');
            $table->foreign('IdClient')->references('IdClient')->on('Clients');
       
        });

        // Contrainte CHECK pour montant positif
        DB::statement('ALTER TABLE Commandes ADD CONSTRAINT chk_montant_positive CHECK (Montant > 0)');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Commandes');
    }
};
