<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
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
        return [
            'review' => $this->faker->sentence,
            'rating' => $this->faker->numberBetween(1, 5),
            'book_id' => Book::factory(),
            'user_id' => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => $this->faker->dateTimeBetween('created_at', 'now'),
        ];
    }

    public function good(): ReviewFactory|Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->numberBetween(4, 5),
            ];
        });
    }

    public function average(): ReviewFactory|Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->numberBetween(2, 4),
            ];
        });
    }

    public function bad(): ReviewFactory|Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->numberBetween(1, 2),
            ];
        });
    }
}
