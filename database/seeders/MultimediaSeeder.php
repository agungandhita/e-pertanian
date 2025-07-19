<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Multimedia;
use App\Models\Kategori;

class MultimediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = Kategori::all();
        
        if ($kategoris->count() > 0) {
            // Sample multimedia data
            $multimediaData = [
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'deskripsi' => 'Video tutorial cara menanam padi yang baik dan benar',
                    'jenis_media' => 'video',
                    'file_path' => null,
                    'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                ],
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'deskripsi' => 'Gambar teknik irigasi modern',
                    'jenis_media' => 'gambar',
                    'file_path' => 'sample_irigasi.jpg',
                    'youtube_url' => null,
                ],
                [
                    'kategori_id' => $kategoris->count() > 1 ? $kategoris->skip(1)->first()->kategori_id : $kategoris->first()->kategori_id,
                    'deskripsi' => 'Video panduan penggunaan pupuk organik',
                    'jenis_media' => 'video',
                    'file_path' => null,
                    'youtube_url' => 'https://www.youtube.com/watch?v=example123',
                ],
                [
                    'kategori_id' => $kategoris->count() > 1 ? $kategoris->skip(1)->first()->kategori_id : $kategoris->first()->kategori_id,
                    'deskripsi' => 'Gambar hasil panen yang berkualitas',
                    'jenis_media' => 'gambar',
                    'file_path' => 'sample_gambar.jpg',
                    'youtube_url' => null,
                ],
                [
                    'kategori_id' => $kategoris->first()->kategori_id,
                    'deskripsi' => 'Video YouTube tentang teknologi pertanian modern',
                    'jenis_media' => 'video',
                    'file_path' => null,
                    'youtube_url' => 'https://www.youtube.com/watch?v=example123',
                ],
            ];

            foreach ($multimediaData as $data) {
                Multimedia::create($data);
            }
        }
    }
}