<?php

namespace Database\Factories;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->numberBetween(10, 12) . '-' . fake()->randomElement(['Science', 'Social', 'Language', 'Computer']),
            'capacity' => fake()->numberBetween(25, 40),
        ];
    }
}
