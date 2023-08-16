<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\Weaning;
use App\Models\Whelping;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weaning>
 */
class WeaningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $whelpingIds = Whelping::whereDoesntHave('weaning')->pluck('id')->toArray();

        $whelping = Whelping::find($this->faker->randomElement($whelpingIds));

            $daysToAdd = rand(30, 35); 

            $newDate = Carbon::parse($whelping->whelping_date)->addDays($daysToAdd);



            return [

            'observation' => $this->faker->sentence,
            
            'whelping_id' => $whelping->id,

            'weaning_date' => $newDate,

            'farm_id' => 1,
            ];

        
    }
}
