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
        Schema::create('Avancement', function (Blueprint $table) {
            $table->string('CodeE');
            $table->string('CodeC');
            $table->string('CodeM');
            $table->decimal('MHRealise', 10, 2)->default(0);

            // Composite primary key
            $table->primary(['CodeE', 'CodeC', 'CodeM']);

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
        Schema::dropIfExists('Avancement');
    }
};
