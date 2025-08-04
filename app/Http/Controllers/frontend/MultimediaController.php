<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Multimedia;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Multimedia::with('kategori')->latest();

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        $multimedias = $query->paginate(12);
        $kategoris = Kategori::all();

        return view('home.multimedia.index', compact('multimedias', 'kategoris'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Multimedia $multimedia)
    {
        // Load comments with user data
        $multimedia->load(['comments.user:id,name,foto']);

        return view('home.multimedia.show', compact('multimedia'));
    }
}
