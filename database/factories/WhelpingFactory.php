<?php

namespace Database\Factories;

use App\Models\Pairing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Whelping>
 */
class WhelpingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     
    public function definition(): array
    {

        $pairing_ids = Pairing::all()
            ->pluck('id')
            ->toArray();

        $pairing = Pairing::find($this->faker->randomElement($pairing_ids));

        $whelpingDate = Carbon::parse($pairing->pairing_date)->addDays($this->faker->randomElement([30, 31, 32, 33, 34]));

        $key = array_search($pairing->id, $pairing_ids);
        unset($pairing_ids[$key]);

        return [
            'whelping_date' => $whelpingDate,
            'observation' => $this->faker->sentence(),
            'pairing_id' => $pairing->id
        ];
    
    }
}
