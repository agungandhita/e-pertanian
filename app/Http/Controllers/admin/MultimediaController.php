<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Multimedia;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            // Validasi dasar
            $rules = [
                'kategori_id' => 'required|exists:kategoris,kategori_id',
                'deskripsi' => 'required|string',
                'jenis_media' => 'required|in:video,audio,gambar,infografis',
                'youtube_url' => 'nullable|url'
            ];

            // Validasi kondisional untuk file
            if ($request->jenis_media === 'video' && $request->filled('youtube_url')) {
                // Jika video dan ada YouTube URL, file tidak wajib
                $rules['file'] = 'nullable|file|max:2048|mimes:mp4,avi,mov';
            } else {
                // Untuk jenis media lainnya, file wajib
                $fileTypes = [];
                switch ($request->jenis_media) {
                    case 'video':
                        $fileTypes = ['mp4', 'avi', 'mov'];
                        break;
                    case 'gambar':
                        $fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                        break;
                    default:
                        $fileTypes = ['mp4', 'avi', 'mov', 'jpg', 'jpeg', 'png', 'gif'];
                }
                $rules['file'] = 'required|file|max:2048|mimes:' . implode(',', $fileTypes);
            }

            $request->validate($rules, [
                'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                'file.mimes' => 'Format file tidak didukung. Gunakan format: MP4, AVI, MOV, JPG, JPEG, PNG, GIF.',
                'youtube_url.url' => 'URL YouTube tidak valid.'
            ]);

            $data = $request->all();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/multimedia', $filename);
                $data['file_path'] = $filename;
            }

            unset($data['file']);
            Multimedia::create($data);

            Alert::success('Berhasil', 'Multimedia berhasil ditambahkan!');
            return redirect()->route('admin.multimedia.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupload file: ' . $e->getMessage());
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
            // Validasi dasar
            $rules = [
                'kategori_id' => 'required|exists:kategoris,kategori_id',
                'deskripsi' => 'required|string',
                'jenis_media' => 'required|in:video,audio,gambar,infografis',
                'youtube_url' => 'nullable|url'
            ];

            // Validasi kondisional untuk file
            if ($request->jenis_media === 'video' && $request->filled('youtube_url')) {
                // Jika video dan ada YouTube URL, file tidak wajib
                $rules['file'] = 'nullable|file|max:2048|mimes:mp4,avi,mov';
            } else {
                // Untuk jenis media lainnya
                $fileTypes = [];
                switch ($request->jenis_media) {
                    case 'video':
                        $fileTypes = ['mp4', 'avi', 'mov'];
                        break;
                    case 'gambar':
                        $fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                        break;
                    default:
                        $fileTypes = ['mp4', 'avi', 'mov', 'jpg', 'jpeg', 'png', 'gif'];
                }
                
                // Jika tidak ada file sebelumnya dan tidak upload file baru, file wajib
                if (!$multimedia->file_path && !$request->hasFile('file')) {
                    $rules['file'] = 'required|file|max:2048|mimes:' . implode(',', $fileTypes);
                } else {
                    $rules['file'] = 'nullable|file|max:2048|mimes:' . implode(',', $fileTypes);
                }
            }

            $request->validate($rules, [
                'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                'file.mimes' => 'Format file tidak didukung. Gunakan format: MP4, AVI, MOV, JPG, JPEG, PNG, GIF.',
                'youtube_url.url' => 'URL YouTube tidak valid.'
            ]);

            $data = $request->all();

            if ($request->hasFile('file')) {
                // Hapus file lama
                if ($multimedia->file_path) {
                    Storage::delete('public/multimedia/' . $multimedia->file_path);
                }

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/multimedia', $filename);
                $data['file_path'] = $filename;
            }

            unset($data['file']);
            $multimedia->update($data);

            Alert::success('Berhasil', 'Multimedia berhasil diperbarui!');
            return redirect()->route('admin.multimedia.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate file: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Multimedia $multimedia)
    {
        // Hapus file
        if ($multimedia->file_path) {
            Storage::delete('public/multimedia/' . $multimedia->file_path);
        }

        $multimedia->delete();

        Alert::success('Berhasil', 'Multimedia berhasil dihapus!');
        return redirect()->route('admin.multimedia.index');
    }
}