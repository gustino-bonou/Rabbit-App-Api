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
        Schema::table('pairings', function (Blueprint $table) {
            $table->enum('result', ['Mis-bas', 'En attente', 'Non renseigné', 'Echoué'])->default('Non renseigné');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pairings', function (Blueprint $table) {
            $table->dropColumn('result');
        });
    }
};
