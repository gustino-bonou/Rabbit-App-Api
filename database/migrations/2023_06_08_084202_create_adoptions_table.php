<?php

use App\Models\Burning;
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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();

            $table->dateTime('adoption_date');
            $table->string('observation');

            $table->foreignId('adoption_mother')->nullable()->references('id')->on('rabbits')->cascadeOnDelete();
            $table->foreignIdFor(Whelping::class)->nullable()->constrained()->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
