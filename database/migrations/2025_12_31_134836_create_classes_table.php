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
        Schema::create('Classes', function (Blueprint $table) {
            $table->string('CodeC')->primary();
            $table->string('CodeD');
            $table->string('Libelle', 40);

            // Foreign key constraint
            $table->foreign('CodeD')->references('CodeD')->on('Departements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Classes');
    }
};
