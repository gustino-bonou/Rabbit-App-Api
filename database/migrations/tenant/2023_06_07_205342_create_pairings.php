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
        Schema::create('pairings', function (Blueprint $table) {
            $table->id();

            $table->dateTime('pairing_date')->default(now());
            $table->string('observation');

            $table->foreignId('father_id')->nullable()->references('id')->on('rabbits')->cascadeOnDelete();
            $table->foreignId('mother_id')->nullable()->references('id')->on('rabbits')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pairings');
    }
};
