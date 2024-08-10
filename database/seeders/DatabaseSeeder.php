<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Parents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        $studentUser = User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
        Student::create([
            'user_id' => $studentUser->id,
            'status' => 'active',
        ]);

        $lecturerUser = User::factory()->create([
            'name' => 'Lecturer User',
            'email' => 'lecturer@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'lecturer',
        ]);
        Lecturer::create([
            'user_id' => $lecturerUser->id,
        ]);

        $parentUser = User::factory()->create([
            'name' => 'Parent User',
            'email' => 'parent@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'parent',
        ]);
        Parents::create([
            'user_id' => $parentUser->id,
        ]);
    }
}
