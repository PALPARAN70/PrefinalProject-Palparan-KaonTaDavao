<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Dish;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Support\Str;


class EaterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // ---- your hand-made eatery ----
    $name = 'Carinderia ni Palparan';

    $mine = Eatery::create([
        'district_id' => District::where('name', 'Poblacion')->value('id'),
        'name' => $name,
        'slug' => Str::slug($name),
        'address' => 'San Pedro St., Poblacion, Davao City',
        'price_range' => 'budget',
        'specialty' => 'Tinolang Manok',
        'is_open' => true,
    ]);

    $mine->features()->sync(
        Feature::whereIn('name', ['Suki ni Palparan', 'Budget Meal'])->pluck('id')
    );

    $mine->permit()->create([
        'permit_no' => 'DVO-2026-0000',   // CHANGE: 0000 -> your birthday MMDD
        'expires_on' => '2027-01-01',     // CHANGE: your birthday in 2027, as YYYY-MM-DD
    ]);

    $mine->dishes()->createMany([
        ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
        ['name' => 'Kinilaw na Tuna', 'price' => 120.00, 'is_bestseller' => false],
        ['name' => 'Durian Shake', 'price' => 75.00, 'is_bestseller' => false],
    ]);

    // ---- 14 factory eateries (11 open + 3 closed) ----
    $featureIds = Feature::pluck('id');

    $others = Eatery::factory()->count(11)->create()
        ->concat(Eatery::factory()->closed()->count(3)->create());

    foreach ($others as $i => $eatery) {
        $permit = Permit::factory()->for($eatery);
        if ($i < 3) {
            $permit = $permit->expired();   // guarantees at least one expired permit
        }
        $permit->create();

        Dish::factory()->count(rand(2, 5))->for($eatery)->create();

        $eatery->features()->attach($featureIds->random(rand(1, 3))->all());
    }
}
}
