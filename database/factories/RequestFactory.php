<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => Instructor::factory(), // Assuming you have an Instructor factory
            'course_id' => Course::factory(), // Assuming you have a Course factory
            'status' => $this->faker->randomElement(['pending', 'accept', 'reject']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
