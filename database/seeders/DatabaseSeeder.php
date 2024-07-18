<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Request;
use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Database\Seeder;
use App\Models\InstructorCourse;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $adminRole = Role::create(['role' => 'admin']);
        $instructorRole = Role::create(['role' => 'instructor']);
        $studentRole = Role::create(['role' => 'student']);

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => $adminRole->id,
        ]);
        User::factory()->count(5)->create(['role_id' => $instructorRole->id]);
        User::factory()->count(10)->create(['role_id' => $studentRole->id]);
        
        Student::factory()->count(10)->create();
        Instructor::factory()->count(5)->create();

        Course::factory()->count(10)->create();
        // Request::factory()->count(5)->create();

        // InstructorCourse::factory()->count(10)->create();
    }
}
