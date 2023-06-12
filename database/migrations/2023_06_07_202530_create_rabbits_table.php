<?php

use App\Models\Adoption;
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
        Schema::create('rabbits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('race')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('burn_date');
            $table->text('description')->nullable();
            $table->enum('gender', ['Mal', 'Femelle']);

            

            $table->timestamps();

        });
    }

    /* relation
    $table->foreignIdFor(Adoption::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Whelping::clas
                        $table->foreignIdFor(Adoption::class)->nullable()->constrained()->cascadeOnDelete();s)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Weaning::class)->nullable()->constrained()->cascadeOnDelete();
    */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rabbits');
    }
};
