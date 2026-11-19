<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $mine = Eatery::where('slug', Str::slug('Carinderia ni Palparan'))->first();
    $luis = User::where('email', 'palparan@kaonta.test')->first();
    $tita = User::where('email', 'tita.palparan@kaonta.test')->first();
    $other = User::where('id', '>', 2)->first();

    $mine->reviews()->createMany([
        ['user_id' => $tita->id, 'rating' => 5, 'body' => 'Lami kaayo! Balik-balikan ni Tita Palparan.'],
        ['user_id' => $luis->id, 'rating' => 4, 'body' => 'Init pa ang tinola, sakto ang timpla.'],
        ['user_id' => $other->id, 'rating' => 5, 'body' => 'Barato na, lami pa ang kinilaw nila.'],
    ]);

    // 0-6 reviews for every OTHER open eatery; closed ones get none
    Eatery::where('is_open', true)
        ->where('id', '!=', $mine->id)
        ->get()
        ->each(function ($eatery) {
            Review::factory()->count(rand(0, 6))->for($eatery)->create();
        });
}
}
