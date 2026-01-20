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
        Schema::table('Cours', function (Blueprint $table) {
            $table->boolean('Valide')->default(false)->after('NbAbsent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Cours', function (Blueprint $table) {
            $table->dropColumn('Valide');
        });
    }
};
