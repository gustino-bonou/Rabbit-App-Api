<?php

namespace Database\Factories;

use App\Models\Rabbit;
use App\Models\Burning;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pairing>
 */
class PairingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $motherIds = Rabbit::where('gender', 'Femelle')
            ->limit(30) // Limitez à 30 femelles
            ->pluck('id')
            ->toArray();

        $fatherIds = Rabbit::where('gender', 'Mal')
            ->limit(7) // Limitez à 30 femelles
            ->pluck('id')
            ->toArray();

        return [
            'observation' => $this->faker->sentence,

            'pairing_date' => $this->faker->dateTimeBetween('-2 years', '-1 year'),

            'mother_id' => $this->faker->randomElement($motherIds),

            'father_id' => $this->faker->randomElement($fatherIds),
        ];
    }
}
