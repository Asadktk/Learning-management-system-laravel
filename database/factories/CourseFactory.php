<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence, // Generates a random sentence
            'description' => $this->faker->paragraph, // Generates a random paragraph
            'fee' => $this->faker->randomFloat(2, 100, 1000), // Generates a random float number between 100 and 1000 with 2 decimal points
            'available_seat' => $this->faker->numberBetween(1, 100), // Generates a random number between 1 and 100
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Generates a random datetime between now and 1 month from now
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
        ];
    }
}
