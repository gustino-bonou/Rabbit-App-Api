<?php

namespace Database\Factories;

use App\Models\Pairing;
use App\Models\Whelping;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Palpation>
 */
class PalpationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $whelpingId = $this->faker->randomElement(Pairing::all()->pluck('id'));

        if($whelpingId != null ){
            $pairing = Pairing::find($whelpingId);
            $daysToAdd = rand(8, 15); 

            $newDate = Carbon::parse($pairing->pairing_date)->addDays($daysToAdd);

            return [

            'result' => $this->faker->randomElement(['Porteuse', 'Non porteuse', 'Inconnu']),
            'pairing_id' => $whelpingId,
            'palpation_date' => $newDate,
            'farm_id' => 1,
            ];
        }

        return [

            'observation' => $this->faker->sentence,

            'whelping_id' => null,

            'weaning_date' => $$this->faker->dateTimeBetween('-1 years', 'now'),
            'farm_id' => 1,
        ];
    }
}
