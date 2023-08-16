<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Pairing;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Builder;

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

        $pairing_ids = Pairing::whereDoesntHave('whelping')

            ->whereHas('palpations', function (Builder $builder) {
                $builder->where('result', 'Porteuse');
            })
            ->pluck('id')
            ->toArray();

        $pairing = Pairing::find($this->faker->randomElement($pairing_ids));

        $whelpingDate = Carbon::parse($pairing->pairing_date)->addDays($this->faker->randomElement([28, 29, 30, 31, 32, 33, 34, 35]));

        $key = array_search($pairing->id, $pairing_ids);
        unset($pairing_ids[$key]);

        return [
            'whelping_date' => $whelpingDate,
            'observation' => $this->faker->sentence(),
            'pairing_id' => $pairing->id,
            'kits_number' => rand(5, 13),
            'deads_kits_number' => rand(0, 2),
        ];
    
    }
}
