<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artikel;
use App\Models\Kategori;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = Kategori::all();
        
        if ($kategoris->count() > 0) {
            $artikelData = [
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'judul' => 'Tips Meningkatkan Produktivitas Padi dengan Metode SRI',
                    'deskripsi' => 'System of Rice Intensification (SRI) adalah metode budidaya padi yang dapat meningkatkan produktivitas hingga 50%. Artikel ini membahas langkah-langkah penerapan metode SRI yang tepat.',
                    'gambar' => 'artikel1.jpg',
                ],
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'judul' => 'Manfaat Pupuk Kompos untuk Kesuburan Tanah',
                    'deskripsi' => 'Pupuk kompos merupakan salah satu pupuk organik yang sangat bermanfaat untuk meningkatkan kesuburan tanah. Artikel ini menjelaskan cara pembuatan dan aplikasi pupuk kompos yang efektif.',
                    'gambar' => 'artikel2.jpg',
                ],
                [
                    'kategori_id' => $kategoris->count() > 1 ? $kategoris->skip(1)->first()->kategori_id : $kategoris->first()->kategori_id,
                    'judul' => 'Penerapan Teknologi IoT dalam Pertanian Modern',
                    'deskripsi' => 'Internet of Things (IoT) mulai banyak diterapkan dalam bidang pertanian. Teknologi ini memungkinkan monitoring dan kontrol otomatis terhadap kondisi tanaman dan lingkungan.',
                    'gambar' => 'artikel3.jpg',
                ],
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'judul' => 'Strategi Pemasaran Hasil Pertanian di Era Digital',
                    'deskripsi' => 'Era digital membuka peluang baru bagi petani untuk memasarkan hasil pertanian mereka. Artikel ini membahas berbagai strategi pemasaran digital yang dapat diterapkan.',
                    'gambar' => 'artikel4.jpg',
                ],
                [
                    'kategori_id' => $kategoris->count() > 1 ? $kategoris->skip(1)->first()->kategori_id : $kategoris->first()->kategori_id,
                    'judul' => 'Cara Mengatasi Serangan Hama Wereng pada Tanaman Padi',
                    'deskripsi' => 'Wereng merupakan salah satu hama utama pada tanaman padi. Artikel ini memberikan panduan lengkap cara mengidentifikasi dan mengatasi serangan hama wereng secara efektif.',
                    'gambar' => 'artikel5.jpg',
                ],
            ];

            foreach ($artikelData as $data) {
                Artikel::create($data);
            }
        }
    }
}