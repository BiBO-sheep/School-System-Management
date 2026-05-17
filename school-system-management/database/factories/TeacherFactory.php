<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory()->create(['role' => 'teacher'])->id,
            'nip' => fake()->unique()->numerify('##################'),
            'specialization' => fake()->randomElement(['Matematika', 'Fisika', 'Biologi', 'Sejarah', 'Bahasa Inggris', 'Informatika', 'Bahasa Indonesia']),
        ];
    }
}
