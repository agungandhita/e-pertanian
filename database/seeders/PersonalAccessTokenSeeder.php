<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class PersonalAccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Personal Access Tokens biasanya dibuat secara dinamis
        // ketika user melakukan login atau request API
        // Seeder ini dibuat untuk kelengkapan struktur
        
        // Jika diperlukan, Anda bisa menambahkan sample token di sini
        // Contoh:
        /*
        $user = User::where('email', 'admin@pertanian.com')->first();
        if ($user) {
            $user->createToken('API Token')->plainTextToken;
        }
        */
    }
}