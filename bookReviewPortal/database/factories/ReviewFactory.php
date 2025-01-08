<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = $this->faker->dateTimeBetween('-2 year', 'now');
        return [
            'book_id' => null,
            'rating' => $this->faker->numberBetween(1, 5),
            'content' => $this->faker->paragraph,
            'created_at' => $created,
            'updated_at' => $this->faker->dateTimeBetween($created, 'now'),
        ];
    }

    public function good(): ReviewFactory|Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(4, 5),
            ];
        });
    }

    public function bad(): ReviewFactory|Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(1, 3),
            ];
        });
    }

    public function average(): ReviewFactory|Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(2, 4),
            ];
        });
    }
}
