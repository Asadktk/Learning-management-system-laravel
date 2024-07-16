<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    protected $model = Instructor::class;

    public function definition()
    {
        $user = User::where('role_id', 2)
            ->whereDoesntHave('instructor')
            ->inRandomOrder()
            ->first();

        // If no such user exists, create a new user with the role of 2
        if (!$user) {
            $user = User::factory()->create(['role_id' => 2]);
        }

        return [
            'user_id' => $user->id,
            // Add any additional fields you need for the Instructor model
        ];
    }
}
