<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clents')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'status' => 1,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '0987654321',
                'status' => 1,
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'phone' => '5551234567',
                'status' => 1,
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob@example.com',
                'phone' => '5557654321',
                'status' => 1,
            ],
            [
                'name' => 'Charlie Davis',
                'email' => 'charlie@example.com',
                'phone' => '5559876543',
                'status' => 1,
            ],
            [
                'name' => 'Diana Evans',
                'email' => 'diana@example.com',
                'phone' => '5553456789',
                'status' => 1,
            ]

        ]);
    }
}
