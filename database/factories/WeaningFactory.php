<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\Whelping;
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
        return [
            'observation' => $this->faker->sentence,
            
            'whelping_id' => function () {
            return $this->faker->randomElement(Whelping::all()->pluck('id'));;
        },
        'adoption_id' => function () {
            return $this->faker->randomElement(Adoption::limit(20)->pluck('id'));
        },
        'weaning_date' => $this->faker->dateTimeBetween('-2 years', '-1 year'),
        ];
    }
}
