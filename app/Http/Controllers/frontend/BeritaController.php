<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::latest()->paginate(9);
        return view('home.berita.index', compact('berita'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('home.berita.show', compact('berita'));
    }
}