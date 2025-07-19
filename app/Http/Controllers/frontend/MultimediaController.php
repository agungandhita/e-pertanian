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
        
        // Filter berdasarkan jenis media jika ada
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_media', $request->jenis);
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
        return view('home.multimedia.show', compact('multimedia'));
    }
}