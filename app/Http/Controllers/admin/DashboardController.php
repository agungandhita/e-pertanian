<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Multimedia;
use App\Models\Modul;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */

    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        // Statistik untuk dashboard
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_students' => User::where('role', 'user')->count(),
            'total_kategoris' => Kategori::count(),
            'total_artikels' => Artikel::count(),
            'total_berita' => Berita::count(),
            'total_multimedia' => Multimedia::count(),
            'total_moduls' => Modul::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_artikel' => Artikel::with('kategori')->latest()->take(5)->get(),
            'recent_berita' => Berita::latest()->take(5)->get(),
            'recent_multimedia' => Multimedia::latest()->take(5)->get(),
            'recent_modul' => Modul::with('kategori')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }


}
