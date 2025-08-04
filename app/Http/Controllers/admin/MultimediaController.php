<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Multimedia;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $multimedia = Multimedia::with('kategori')->latest()->paginate(10);
        return view('admin.multimedia.index', compact('multimedia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.multimedia.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'kategori_id' => 'required|exists:kategoris,kategori_id',
                'deskripsi' => 'required|string',
                'youtube_url' => 'nullable|url'
            ], [
                'youtube_url.url' => 'URL YouTube tidak valid.'
            ]);

            Multimedia::create($request->all());

            Alert::success('Berhasil', 'Multimedia berhasil ditambahkan!');
            return redirect()->route('admin.multimedia.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Multimedia $multimedia)
    {
        return view('admin.multimedia.show', compact('multimedia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Multimedia $multimedia)
    {
        $kategoris = Kategori::all();
        return view('admin.multimedia.edit', compact('multimedia', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        try {
            $request->validate([
                'kategori_id' => 'required|exists:kategoris,kategori_id',
                'deskripsi' => 'required|string',
                'youtube_url' => 'nullable|url'
            ], [
                'youtube_url.url' => 'URL YouTube tidak valid.'
            ]);

            $multimedia->update($request->all());

            Alert::success('Berhasil', 'Multimedia berhasil diperbarui!');
            return redirect()->route('admin.multimedia.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Multimedia $multimedia)
    {
        $multimedia->delete();

        Alert::success('Berhasil', 'Multimedia berhasil dihapus!');
        return redirect()->route('admin.multimedia.index');
    }
}
