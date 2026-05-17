<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['Laki-laki', 'Perempuan']);
        return [
            'user_id' => \App\Models\User::factory()->create(['role' => 'student'])->id,
            'school_class_id' => \App\Models\SchoolClass::inRandomOrder()->first()->id ?? \App\Models\SchoolClass::factory(),
            'nisn' => fake()->unique()->numerify('##########'),
            'gender' => $gender,
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
