<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modul;
use App\Models\Kategori;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = Kategori::all();
        
        if ($kategoris->count() > 0) {
            $modulData = [
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'judul' => 'Panduan Lengkap Budidaya Padi',
                    'deskripsi' => 'Panduan komprehensif untuk budidaya padi yang efektif dan berkelanjutan.',
                    'konten' => 'Modul pembelajaran lengkap tentang budidaya padi mulai dari persiapan lahan, penanaman, perawatan, hingga panen. Dilengkapi dengan gambar dan video tutorial.',
                    'file_path' => 'modul_budidaya_padi.pdf',
                ],
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'judul' => 'Teknik Irigasi Modern untuk Petani',
                    'deskripsi' => 'Teknik irigasi terkini untuk optimalisasi penggunaan air dalam pertanian.',
                    'konten' => 'Modul yang membahas berbagai teknik irigasi modern yang dapat diterapkan oleh petani untuk mengoptimalkan penggunaan air dalam pertanian.',
                    'file_path' => 'modul_irigasi_modern.pdf',
                ],
                [
                    'kategori_id' => $kategoris->count() > 1 ? $kategoris->skip(1)->first()->kategori_id : $kategoris->first()->kategori_id,
                    'judul' => 'Pengendalian Hama dan Penyakit Tanaman',
                    'deskripsi' => 'Strategi efektif untuk mengidentifikasi dan mengendalikan hama serta penyakit tanaman.',
                    'konten' => 'Modul pembelajaran tentang cara mengidentifikasi dan mengendalikan berbagai jenis hama dan penyakit yang menyerang tanaman pertanian.',
                    'file_path' => 'modul_pengendalian_hama.pdf',
                ],
                [
                    'kategori_id' => $kategoris->count() > 1 ? $kategoris->skip(1)->first()->kategori_id : $kategoris->first()->kategori_id,
                    'judul' => 'Pupuk Organik dan Aplikasinya',
                    'deskripsi' => 'Panduan pembuatan dan penggunaan pupuk organik untuk meningkatkan kesuburan tanah.',
                    'konten' => 'Panduan lengkap tentang pembuatan dan penggunaan pupuk organik untuk meningkatkan kesuburan tanah dan produktivitas tanaman.',
                    'file_path' => 'modul_pupuk_organik.pdf',
                ],
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'judul' => 'Teknologi Pertanian 4.0',
                    'deskripsi' => 'Penerapan teknologi terkini dalam bidang pertanian modern.',
                    'konten' => 'Modul yang membahas tentang penerapan teknologi terkini dalam bidang pertanian, termasuk IoT, AI, dan sistem otomasi.',
                    'file_path' => 'modul_teknologi_pertanian.pdf',
                ],
            ];

            foreach ($modulData as $data) {
                Modul::create($data);
            }
        }
    }
}