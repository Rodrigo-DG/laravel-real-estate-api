<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('properties')->insert([
            [
                'address' => 'Las condes, Testing 123',
                'city' => 'Santiago',
                'price' => 5000000,
                'description' => 'Casa ubicada en Las condes, Testing 123 - Santiago',
                'status' => 1,
            ],
            [
                'address' => 'Providencia, Testing 123',
                'city' => 'Santiago',
                'price' => 5000000,
                'description' => 'Casa ubicada en Providencia, Testing 123 - Santiago',
                'status' => 1,
            ],
            [
                'address' => 'Macul, Testing 123',
                'city' => 'Santiago',
                'price' => 5000000,
                'description' => 'Casa ubicada en Macul, Testing 123 - Santiago',
                'status' => 1,
            ],
            [
                'address' => 'Chacabuco, Testing 123',
                'city' => 'Concepción',
                'price' => 5000000,
                'description' => 'Casa ubicada en Chacabuco, Testing 123 - Concepción',
                'status' => 1,
            ],
            [
                'address' => 'Coronel, Testing 123',
                'city' => 'Concepción',
                'price' => 5000000,
                'description' => 'Casa ubicada en Coronel, Testing 123 - Concepción',
                'status' => 1,
            ],
            [
                'address' => 'Baquedano, Testing 123',
                'city' => 'Iquique',
                'price' => 5000000,
                'description' => 'Casa ubicada en Baquedano, Testing 123 - Iquique',
                'status' => 1,
            ]

        ]);
    }
}
