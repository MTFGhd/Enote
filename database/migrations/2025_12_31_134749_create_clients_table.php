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
        Schema::create('Clients', function (Blueprint $table) {
            $table->uuid('IdClient');
            $table->string('Nom');
            $table->string('Email')->unique();
            $table->string('Adresse', 255);

//  ____________ Les Contraintes _______________

            $table->primary('IdClient');
        });

        // Contrainte CHECK pour la longueur minimale de l'adresse
        DB::statement('ALTER TABLE Clients ADD CONSTRAINT chk_adresse_length CHECK (CHAR_LENGTH(Adresse) >= 10)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Clients');
    }
};
