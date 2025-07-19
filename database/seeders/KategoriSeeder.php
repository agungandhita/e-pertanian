<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Tanaman Pangan'],
            ['nama' => 'Hortikultura'],
            ['nama' => 'Perkebunan'],
            ['nama' => 'Peternakan'],
            ['nama' => 'Perikanan'],
            ['nama' => 'Teknologi Pertanian'],
            ['nama' => 'Pengolahan Hasil Pertanian'],
            ['nama' => 'Agribisnis'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}