<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $names = ['Poblacion', 'Talomo', 'Agdao', 'Buhangin', 'Toril', 'Tugbok'];

    foreach ($names as $name) {
        District::create(['name' => $name]);
    }
}
}
