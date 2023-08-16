<?php

namespace Database\Factories;

use App\Models\Rabbit;
use App\Models\Whelping;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adoption>
 */
class AdoptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $whelpingId = $this->faker->randomElement(Whelping::all()->pluck('id'));

        $whelping = Whelping::find($whelpingId);

        $daysToAdd = rand(0, 1); 

            $newDate = Carbon::parse($whelping->whelping_date)->addDays($daysToAdd);

        return [
            'whelping_id' => $whelpingId,
            'adoption_date' => $newDate,
            'observation' => $this->faker->sentence(),
            'kit_number' => rand(1, 3), 
            'adoption_mother' => function () {

                return $this->faker->randomElement(Rabbit::where('gender', 'Femelle')
                ->whereHas('whelping')
                ->pluck('id'));
            },
        ];
    }
}
