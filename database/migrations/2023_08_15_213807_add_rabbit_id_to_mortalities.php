<?php

use App\Models\Rabbit;
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
            $table->foreignIdFor(Rabbit::class);
            $table->date('died_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mortalities', function (Blueprint $table) {
            $table->dropColumn('rabbit_id');
            $table->dropColumn('died_date');
        });
    }
};
