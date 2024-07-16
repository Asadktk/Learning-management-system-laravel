<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        $user = User::where('role_id', 3)
            ->whereDoesntHave('instructor')
            ->inRandomOrder()
            ->first();

        // If no such user exists, create a new user with the role of 2
        if (!$user) {
            $user = User::factory()->create(['role_id' => 3]);
        }

        return [
            'user_id' => $user->id,
            // Add any additional fields you need for the Instructor model
        ];
    }
}
