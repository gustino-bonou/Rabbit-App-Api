<?php

use App\Models\Farm;
use App\Models\User;
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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::table('rabbits', function (Blueprint $table) {

            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('pairings', function (Blueprint $table) {

            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('weanings', function (Blueprint $table) {

            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('whelpings', function (Blueprint $table) {

            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });
        Schema::table('adoptions', function (Blueprint $table) {

            $table->foreignIdFor(Farm::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');

        Schema::table('adoptions', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });
        Schema::table('rabbits', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });
        Schema::table('pairings', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });
        Schema::table('weanings', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });
        Schema::table('whelpings', function (Blueprint $table) {
            $table->dropColumn('farm_id');
        });
    }
    
};
