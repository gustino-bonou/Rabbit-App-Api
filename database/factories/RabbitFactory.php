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
        $gender = $this->faker->randomElement(['Mal', 'Femelle']);
        return [
            'name' => $gender === 'Femelle' ? $this->faker->firstNameFemale : $this->faker->firstNameMale,
            'description' => $this->faker->sentence,
            'race' => $this->faker->randomElement(['Lionhead', 'Dutch', 'Flemish Giant', 'American Chinchilla [US]', 'Argente Bleu', 'Canadian Plush Lop']),
            'image' => $this->faker->imageUrl(),
            'gender' => $gender,
            'whelping_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
    
}
