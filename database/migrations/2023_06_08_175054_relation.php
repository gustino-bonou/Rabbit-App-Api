<?php

use App\Models\Weaning;
use App\Models\Adoption;
use App\Models\Whelping;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rabbits', function (Blueprint $table) {
            $table->foreignIdFor(Adoption::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Whelping::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Weaning::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
