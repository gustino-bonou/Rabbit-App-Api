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
        Schema::table('whelpings', function (Blueprint $table) {
            $table->integer('kits_number')->nullable();
            $table->integer('deads_kits_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whelpings', function (Blueprint $table) {
            $table->dropColumn(['kits_number', 'deads_kits_number']);
        });
    }
};
