<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::latest()->paginate(9);
        return view('home.artikel.index', compact('artikels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('home.artikel.show', compact('artikel'));
    }
}