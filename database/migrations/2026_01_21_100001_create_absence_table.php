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
        Schema::create('Absence', function (Blueprint $table) {
            $table->string('CodeE');
            $table->unsignedBigInteger('NumC');
            $table->date('Jour');
            $table->decimal('Duree', 10, 2);

            // Composite primary key
            $table->primary(['CodeE', 'NumC']);

            // Foreign key constraints
            $table->foreign('CodeE')->references('CodeE')->on('Etudiants')->onDelete('cascade');
            $table->foreign('NumC')->references('NumC')->on('Cours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Absence');
    }
};
