<?php

namespace Database\Factories;

use App\Models\Rabbit;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mortality>
 */
class MortalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $motherIds = Rabbit::where('isParent', 0) 
            ->pluck('id')
            ->toArray();

        $rabbit_id = $this->faker->randomElement($motherIds);

        $rabbit = Rabbit::find($rabbit_id);

        $daysToAdd = rand(15, 120); 

        $newDate = Carbon::parse($rabbit->whelping_date)->addDays($daysToAdd)->toDate();
        
        return [
            'rabbit_id' => $rabbit->id,
            'died_date' => $newDate,
            'farm_id' => 1,
        ];
    }
}
