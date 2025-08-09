<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Kategori;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada kategori terlebih dahulu
        $kategoriPertanian = Kategori::firstOrCreate(['nama' => 'Pertanian']);
        $kategoriPerkebunan = Kategori::firstOrCreate(['nama' => 'Perkebunan']);
        $kategoriPeternakan = Kategori::firstOrCreate(['nama' => 'Peternakan']);

        $products = [
            [
                'nama' => 'Benih Padi Unggul IR64',
                'deskripsi' => 'Benih padi varietas IR64 dengan kualitas unggul, tahan hama dan penyakit, cocok untuk lahan sawah.',
                'harga' => 25000,
                'stok' => 100,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'kg',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Pupuk NPK 16-16-16',
                'deskripsi' => 'Pupuk majemuk NPK dengan kandungan nitrogen, fosfor, dan kalium yang seimbang untuk pertumbuhan tanaman optimal.',
                'harga' => 85000,
                'stok' => 50,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'karung 25kg',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Pestisida Organik Neem',
                'deskripsi' => 'Pestisida organik dari ekstrak neem yang ramah lingkungan, efektif mengendalikan hama tanaman.',
                'harga' => 45000,
                'stok' => 75,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'liter',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Bibit Jagung Hibrida',
                'deskripsi' => 'Bibit jagung hibrida dengan produktivitas tinggi, tahan kekeringan dan hasil panen melimpah.',
                'harga' => 35000,
                'stok' => 80,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'kg',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Pupuk Kompos Organik',
                'deskripsi' => 'Pupuk kompos organik berkualitas tinggi untuk memperbaiki struktur tanah dan meningkatkan kesuburan.',
                'harga' => 15000,
                'stok' => 200,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'karung 20kg',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Benih Cabai Rawit',
                'deskripsi' => 'Benih cabai rawit varietas unggul dengan tingkat kepedasan tinggi dan produktivitas baik.',
                'harga' => 12000,
                'stok' => 150,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'gram',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Bibit Kelapa Sawit',
                'deskripsi' => 'Bibit kelapa sawit unggul dengan potensi produksi tinggi, cocok untuk perkebunan skala besar.',
                'harga' => 25000,
                'stok' => 500,
                'kategori_id' => $kategoriPerkebunan->kategori_id,
                'satuan' => 'batang',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Benih Kopi Arabika',
                'deskripsi' => 'Benih kopi arabika premium dengan cita rasa khas, cocok untuk dataran tinggi.',
                'harga' => 55000,
                'stok' => 30,
                'kategori_id' => $kategoriPerkebunan->kategori_id,
                'satuan' => 'kg',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Pakan Ayam Broiler',
                'deskripsi' => 'Pakan ayam broiler dengan nutrisi lengkap untuk pertumbuhan optimal dan kualitas daging terbaik.',
                'harga' => 320000,
                'stok' => 25,
                'kategori_id' => $kategoriPeternakan->kategori_id,
                'satuan' => 'karung 50kg',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Vitamin Ternak Unggas',
                'deskripsi' => 'Vitamin dan mineral untuk unggas guna meningkatkan daya tahan tubuh dan produktivitas telur.',
                'harga' => 75000,
                'stok' => 40,
                'kategori_id' => $kategoriPeternakan->kategori_id,
                'satuan' => 'botol 1L',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Alat Semprot Punggung',
                'deskripsi' => 'Alat semprot punggung kapasitas 16 liter untuk aplikasi pestisida dan pupuk cair.',
                'harga' => 450000,
                'stok' => 15,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'unit',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Cangkul Pertanian',
                'deskripsi' => 'Cangkul berkualitas tinggi dengan gagang kayu yang kuat, cocok untuk mengolah tanah.',
                'harga' => 85000,
                'stok' => 60,
                'kategori_id' => $kategoriPertanian->kategori_id,
                'satuan' => 'unit',
                'status' => 'aktif'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}