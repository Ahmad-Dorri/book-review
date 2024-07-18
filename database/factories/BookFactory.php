<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'author_id' => Author::factory(),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => $this->faker->dateTimeBetween('created_at', 'now'),
        ];
    }
}
