<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Adoption;
use App\Models\Farm;
use App\Models\Pairing;
use App\Models\Rabbit;
use App\Models\User;
use App\Models\Weaning;
use App\Models\Whelping;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Database\Factories\RabbitFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       /*  Whelping::factory()->count(50)->create(); */

    Adoption::factory()->count(2)->create();

    }


}



