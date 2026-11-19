<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Eatery;
use App\Models\User;
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
    return [
        'eatery_id' => Eatery::factory(),
        'user_id' => User::inRandomOrder()->value('id'),
        'rating' => fake()->numberBetween(1, 5),
        'body' => fake()->sentence(10),
    ];
}
}
