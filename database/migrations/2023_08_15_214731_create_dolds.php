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
            $table->foreignIdFor(Rabbit::class)->change()->nullable()->constrained()->cascadeOnDelete();
            $table->date('died_date')->default(now())->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
