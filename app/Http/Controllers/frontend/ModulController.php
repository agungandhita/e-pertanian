<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Modul::with('kategori')->latest();
        
        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }
        
        $moduls = $query->paginate(9);
        $kategoris = Kategori::all();
        
        return view('home.modul.index', compact('moduls', 'kategoris'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Modul $modul)
    {
        return view('home.modul.show', compact('modul'));
    }

    /**
     * Download the specified resource.
     */
    public function download(Modul $modul)
    {
        $filePath = 'public/modul/' . $modul->file_pdf;
        
        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $modul->file_pdf);
        }
        
        abort(404, 'File tidak ditemukan');
    }
}