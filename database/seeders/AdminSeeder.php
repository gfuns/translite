<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'lastName' => 'Peace MFB',
            'firstName' => 'Admin',
            'email' => 'admin@peacemfb.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);
    }
}
