<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visits')->insert([
            [
                'client_id' => 1,
                'property_id' => 1,
                'visit_date' => now()->addDays(1),
                'comments' => 'Primera visita, Santiago.',
                'status' => 1,
            ],
            [
                'client_id' => 2,
                'property_id' => 2,
                'visit_date' => now()->addDays(2),
                'comments' => 'Primera visita, Santiago.',
                'status' => 1,
            ],
            [
                'client_id' => 3,
                'property_id' => 3,
                'visit_date' => now()->addDays(3),
                'comments' => 'Primera visita, Santiago.',
                'status' => 1,
            ],
            [
                'client_id' => 4,
                'property_id' => 4,
                'visit_date' => now()->addDays(4),
                'comments' => 'Primera visita, Concepción.',
                'status' => 1,
            ],
            [
                'client_id' => 5,
                'property_id' => 5,
                'visit_date' => now()->addDays(5),
                'comments' => 'Primera visita, Concepción.',
                'status' => 1,
            ],
            [
                'client_id' => 6,
                'property_id' => 6,
                'visit_date' => now()->addDays(6),
                'comments' => 'Primera visita, Iquique.',
                'status' => 1,
            ],

        ]);
    }
}
