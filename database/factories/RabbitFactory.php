<?php

namespace Database\Factories;

use App\Models\Weaning;
use App\Models\Adoption;
use App\Models\Whelping;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rabbit>
 */
class RabbitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstNameFemale,
            'description' => $this->faker->sentence,
            'race' => $this->faker->randomElement(['Lionhead', 'Dutch', 'Flemish Giant']),
            'image' => $this->faker->imageUrl(),
            'gender' => $this->faker->randomElement(['Mal', 'Femelle']),
            'whelping_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
    
}
