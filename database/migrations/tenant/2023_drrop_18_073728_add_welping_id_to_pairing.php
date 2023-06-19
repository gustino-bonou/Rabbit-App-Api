<?php

use App\Models\Weaning;
use App\Models\Whelping;
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
            $table->foreignIdFor(Whelping::class)->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('whelpings', function (Blueprint $table) {
            $table->foreignIdFor(Weaning::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pairing', function (Blueprint $table) {
            //
        });
    }
};
