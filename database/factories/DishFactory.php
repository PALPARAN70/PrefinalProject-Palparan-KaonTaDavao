<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Eatery;
/**
 * @extends Factory<Dish>
 */
class DishFactory extends Factory
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
        'name' => fake()->randomElement(['Sinigang na Baboy', 'Adobo', 'Kare-Kare', 'Bulalo', 'Sisig', 'Pancit Bihon', 'Inihaw na Liempo', 'Halo-Halo', 'Tuna Panga', 'Chicken Inasal']),
        'price' => fake()->randomFloat(2, 40, 300),
        'is_bestseller' => false,
    ];
}
}
