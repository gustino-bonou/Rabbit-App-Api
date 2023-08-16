<?php

use App\Models\Farm;
use App\Models\Sale;
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
        Schema::table('mortalities', function (Blueprint $table) {
            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mortalities', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });
    }
};
