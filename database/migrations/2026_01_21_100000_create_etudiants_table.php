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
        Schema::create('Etudiants', function (Blueprint $table) {
            $table->string('CodeE')->primary();
            $table->string('Nom', 50);
            $table->string('Prenom', 50);
            $table->string('email')->unique();
            $table->string('CodeC');

            // Foreign key constraint
            $table->foreign('CodeC')->references('CodeC')->on('Classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Etudiants');
    }
};
