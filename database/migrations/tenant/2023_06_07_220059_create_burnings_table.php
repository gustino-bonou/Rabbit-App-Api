<?php

use App\Models\Pairing;
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
        Schema::create('whelpings', function (Blueprint $table) {
            $table->id();

            $table->dateTime('whelping_date')->default(now());

            $table->text('observation')->nullable();

            $table->foreignIdFor(Pairing::class)->nullable()->constrained()->cascadeOnDelete();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burnings');
    } 
};
