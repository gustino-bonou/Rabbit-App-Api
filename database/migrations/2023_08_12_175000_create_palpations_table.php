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
        Schema::create('palpations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('palpation_date')->default(now());
            $table->enum('result', ['Porteuse', 'Non porteuse', 'Inconnu']);
            $table->foreignIdFor(Pairing::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palpations');
    }
};
