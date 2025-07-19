<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default jika belum ada
        if (!User::where('email', 'admin@pertanian.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@pertanian.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Buat beberapa user sample
        if (!User::where('email', 'user@pertanian.com')->exists()) {
            User::create([
                'name' => 'User Sample',
                'email' => 'user@pertanian.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }
    }
}