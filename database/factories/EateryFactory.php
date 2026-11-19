<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\District;
use Illuminate\Support\Str;
/**
 * @extends Factory<Eatery>
 */
class EateryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $name = 'Kainan ni ' . fake()->unique()->lastName();

    return [
        'district_id' => District::inRandomOrder()->value('id'),
        'name' => $name,
        'slug' => Str::slug($name),
        'address' => fake()->streetAddress() . ', Davao City',
        'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
        'specialty' => fake()->randomElement(['Kinilaw', 'Sinuglaw', 'Tinola', 'Lechon Manok', 'Durian Shake', 'Pastil']),
        'is_open' => true,
    ];
}

public function closed(): static
{
    return $this->state(fn (array $attributes) => ['is_open' => false]);
}
}
