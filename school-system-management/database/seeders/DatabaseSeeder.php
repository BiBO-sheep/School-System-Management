<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Superadmin User
        User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@school.test',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        // 2. Fixed Test Accounts for Mobile App Login
        $demoTeacher = Teacher::factory()->create();
        $demoTeacher->user->update([
            'name' => 'Demo Teacher',
            'email' => 'teacher@school.test',
            'password' => Hash::make('password')
        ]);

        $demoStudent = Student::factory()->create();
        $demoStudent->user->update([
            'name' => 'Demo Student',
            'email' => 'student@school.test',
            'password' => Hash::make('password')
        ]);

        $demoParent = StudentParent::factory()->create();
        $demoParent->user->update([
            'name' => 'Demo Parent',
            'email' => 'parent@school.test',
            'password' => Hash::make('password')
        ]);
        $demoParent->students()->attach($demoStudent->id);

        // 2. 10 Classes
        SchoolClass::factory(10)->create();

        // 3. 20 Teachers
        Teacher::factory(20)->create();

        // 4. 100 Students (assigned randomly to classes in factory)
        $students = Student::factory(100)->create();

        // 5. 50 Parents (each parent randomly assigned 1 to 3 students)
        StudentParent::factory(50)->create()->each(function ($parent) use ($students) {
            $parent->students()->attach(
                $students->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
