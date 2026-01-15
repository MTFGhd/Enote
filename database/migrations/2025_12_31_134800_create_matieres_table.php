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
        Schema::create('Matieres', function (Blueprint $table) {
            $table->string('CodeM')->primary();
            $table->string('CodeD');
            $table->decimal('MH', 10, 2);
            $table->enum('Coef', ['1', '3', '5']);

            // Foreign key constraint
            $table->foreign('CodeD')->references('CodeD')->on('Departements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Matieres');
    }
};
