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
        Schema::create('Cours', function (Blueprint $table) {
            $table->id('NumC');
            $table->string('CodeE');
            $table->string('CodeC');
            $table->string('CodeM');
            $table->enum('Type', ['C', 'T', 'E']);
            $table->date('Jour');
            $table->time('HeureDebut');
            $table->time('HeureFin');
            $table->decimal('Duree', 10, 2);
            $table->integer('NbAbsent')->nullable();

            // Foreign key constraints
            $table->foreign('CodeE')->references('CodeE')->on('Enseignants')->onDelete('cascade');
            $table->foreign('CodeC')->references('CodeC')->on('Classes')->onDelete('cascade');
            $table->foreign('CodeM')->references('CodeM')->on('Matieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Cours');
    }
};
