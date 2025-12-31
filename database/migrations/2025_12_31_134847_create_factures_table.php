<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Factures', function (Blueprint $table) {
            $table->id('IdFact');
            $table->dateTime('DateFact');
            $table->unsignedBigInteger('IdCde');

   // ____________ Les Contraintes _______________

            $table->primary('IdFact');
            $table->foreign('IdCde')->references('IdCde')->on('Commandes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Factures');
    }
};
