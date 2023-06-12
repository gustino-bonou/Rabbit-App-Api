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
        return [
            'observation' => $this->faker->sentence,

            'pairing_date' => $this->faker->dateTimeBetween('-2 years', '-1 year'),

            'mother_id' => function () {
                return $this->faker->randomElement(Rabbit::where('gender', 'Femelle')->pluck('id'));
            },

            'father_id' => function () {
                return $this->faker->randomElement(Rabbit::where('gender', 'Mal')->pluck('id'));
            },
        ];
    }
}
