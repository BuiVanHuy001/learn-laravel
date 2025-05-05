<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'experience' => $this->faker->randomElement(Job::$experiences),
            'category' => $this->faker->randomElement(Job::$categories),
            'salary' => $this->faker->numberBetween(3_000, 120_000),
        ];
    }
}
