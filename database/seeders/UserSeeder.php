<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Demo',
                'email' => 'demo@demo.com',
                'password' => bcrypt('demo1234'),
            ]

        ]);
    }
}
