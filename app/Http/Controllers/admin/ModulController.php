<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moduls = Modul::with('kategori')->latest()->paginate(10);
        return view('admin.modul.index', compact('moduls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.modul.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'required|file|mimes:pdf|max:10240' // 10MB max
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = 'cover_' . time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/modul/covers', $filename);
            $data['cover'] = $filename;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/modul/files', $filename);
            $data['file_path'] = $filename;
        }

        Modul::create($data);

        Alert::success('Berhasil', 'Modul berhasil ditambahkan!');
        return redirect()->route('admin.modul.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modul $modul)
    {
        return view('admin.modul.show', compact('modul'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modul $modul)
    {
        $kategoris = Kategori::all();
        return view('admin.modul.edit', compact('modul', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        $request->validate([
            'judul' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,kategori_id',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // Hapus file cover lama
            if ($modul->cover) {
                Storage::delete('public/modul/covers/' . $modul->cover);
            }

            $file = $request->file('cover');
            $filename = 'cover_' . time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/modul/covers', $filename);
            $data['cover'] = $filename;
        }

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($modul->file_path) {
                Storage::delete('public/modul/files/' . $modul->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/modul/files', $filename);
            $data['file_path'] = $filename;
        }

        $modul->update($data);

        Alert::success('Berhasil', 'Modul berhasil diperbarui!');
        return redirect()->route('admin.modul.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        // Hapus file cover
        if ($modul->cover) {
            Storage::delete('public/modul/covers/' . $modul->cover);
        }

        // Hapus file PDF
        if ($modul->file_path) {
            Storage::delete('public/modul/files/' . $modul->file_path);
        }

        $modul->delete();

        Alert::success('Berhasil', 'Modul berhasil dihapus!');
        return redirect()->route('admin.modul.index');
    }
}
