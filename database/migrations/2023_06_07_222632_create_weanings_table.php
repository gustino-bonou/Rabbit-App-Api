<?php

use App\Models\Adoption;
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
        Schema::create('weanings', function (Blueprint $table) {
            $table->id();

            $table->string('observation');
            $table->dateTime('weaning_date')->default(now());

            $table->foreignIdFor(Whelping::class)->nullable()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weanings');
    }
};
