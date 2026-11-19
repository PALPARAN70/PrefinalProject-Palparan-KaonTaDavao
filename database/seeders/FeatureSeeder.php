<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $names = ['Suki ni Palparan', 'Budget Meal', 'Halal', 'Open 24 Hours', 'Aircon', 'Free Wifi'];

    foreach ($names as $name) {
        Feature::create(['name' => $name]);
    }
}
}
