<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('design_types')->truncate();
        // Define the data to be inserted
        $designTypes = [
            [
                'id' => 1,
                'type' => 'Result',
                'order' => 1,
                'isPro' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'type' => 'List',
                'order' => 2,
                'isPro' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'type' => 'Static',
                'order' => 3,
                'isPro' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'type' => 'Banner',
                'order' => 4,
                'isPro' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'type' => 'Calculator',
                'order' => 5,
                'isPro' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert the data into the design_types table
        DB::table('design_types')->insert($designTypes);
    }
}
