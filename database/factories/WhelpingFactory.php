<?php

namespace Database\Factories;

use App\Models\Pairing;
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
        return [
            'whelping_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'observation' => $this->faker->sentence(),
            'pairing_id' => function () {
            return $this->faker->randomElement(Pairing::all()->pluck('id'));
        },
        ];
    }
}
