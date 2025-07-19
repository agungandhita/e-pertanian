<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Multimedia;
use App\Models\Modul;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda
     */
    public function index()
    {
        // Ambil data untuk ditampilkan di beranda
        $artikelTerbaru = Artikel::latest()->take(3)->get();
        $beritaTerbaru = Berita::latest()->take(3)->get();
        $multimediaTerbaru = Multimedia::latest()->take(6)->get();
        $modulTerbaru = Modul::latest()->take(3)->get();
        $kategori = Kategori::withCount(['multimedia', 'moduls'])->get();
        
        // Statistik untuk hero section
        $statistik = [
            'total_artikel' => Artikel::count(),
            'total_berita' => Berita::count(),
            'total_multimedia' => Multimedia::count(),
            'total_modul' => Modul::count(),
            'total_kategori' => Kategori::count()
        ];
        
        return view('home.beranda.index', compact(
            'artikelTerbaru',
            'beritaTerbaru', 
            'multimediaTerbaru',
            'modulTerbaru',
            'kategori',
            'statistik'
        ));
    }
    
    /**
     * Menampilkan halaman profil desa
     */
    public function profil()
    {
        return view('home.profile.index');
    }
}