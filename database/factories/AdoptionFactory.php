<?php

namespace Database\Factories;

use App\Models\Rabbit;
use App\Models\Whelping;
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
        return [
            'whelping_id' => function () {
                return Whelping::factory()->create()->id;
            },
            'adoption_date' => $this->faker->dateTimeBetween('-2 years', '-1 year'),
            'observation' => $this->faker->sentence(),
            'adoption_mother' => function () {
                return $this->faker->randomElement(Rabbit::where('gender', 'Femelle')->limit(10)->pluck('id'));
            },
        ];
    }
}
