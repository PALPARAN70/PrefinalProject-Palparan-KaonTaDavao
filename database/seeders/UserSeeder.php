<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::create([
        'name' => 'Luis Palparan',
        'email' => 'palparan@kaonta.test',
        'password' => Hash::make('kaonta2026'),
    ]);

    User::create([
        'name' => 'Tita Palparan',
        'email' => 'tita.palparan@kaonta.test',
        'password' => Hash::make('kaonta2026'),
    ]);

    User::factory()->count(10)->create();
}
}
