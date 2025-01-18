<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin@poultry_master',
            'email' => 'admin@poultrymasterbd.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
