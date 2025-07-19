<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\Kategori;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = Kategori::all();
        
        if ($kategoris->count() > 0) {
            $beritaData = [
                [
                    'judul' => 'Pemerintah Luncurkan Program Bantuan Bibit Unggul',
                    'isi' => 'Pemerintah melalui Kementerian Pertanian meluncurkan program bantuan bibit unggul untuk petani di seluruh Indonesia. Program ini bertujuan untuk meningkatkan produktivitas dan kualitas hasil panen.',
                    'gambar' => 'berita1.jpg',
                ],
                [
                    'judul' => 'Teknologi Drone Mulai Diterapkan dalam Pertanian',
                    'isi' => 'Penggunaan teknologi drone dalam bidang pertanian semakin populer. Teknologi ini membantu petani dalam monitoring tanaman dan penyemprotan pestisida dengan lebih efisien.',
                    'gambar' => 'berita2.jpg',
                ],
                [
                    'judul' => 'Harga Gabah Naik Signifikan di Pasar Lokal',
                    'isi' => 'Harga gabah mengalami kenaikan yang signifikan di berbagai pasar lokal. Hal ini disebabkan oleh meningkatnya permintaan dan berkurangnya stok di gudang-gudang penyimpanan.',
                    'gambar' => 'berita3.jpg',
                ],
                [
                    'judul' => 'Workshop Pertanian Organik untuk Petani Muda',
                    'isi' => 'Dinas Pertanian mengadakan workshop khusus tentang pertanian organik yang ditujukan untuk petani muda. Workshop ini bertujuan untuk meningkatkan pengetahuan tentang metode pertanian ramah lingkungan.',
                    'gambar' => 'berita4.jpg',
                ],
            ];

            foreach ($beritaData as $data) {
                Berita::create($data);
            }
        }
    }
}