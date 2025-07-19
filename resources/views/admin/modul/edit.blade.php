@extends('admin.layouts.main')

@section('title', 'Edit Modul - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Edit Modul</h2>
        <p class="text-muted mb-0">Ubah data modul pembelajaran</p>
    </div>
    <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Modul</h5>
            </div>
            <form action="{{ route('admin.modul.update', $modul) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Modul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" value="{{ old('judul') ?? $modul->judul }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori_id') is-invalid @enderror"
                                id="kategori_id" name="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->kategori_id }}" 
                                        {{ (old('kategori_id') ?? $modul->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') ?? $modul->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten Modul <span class="text-danger">*</span></label>
                        <textarea class="form-control froala-editor @error('konten') is-invalid @enderror"
                                  id="konten" name="konten" rows="10" required>{{ old('konten') ?? $modul->konten }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cover" class="form-label">Cover Modul</label>
                                <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                       id="cover" name="cover" accept="image/*">
                                <div class="form-text">
                                    Format: JPG, PNG, GIF (Maks. 2MB)<br>
                                    <em>Kosongkan jika tidak ingin mengubah cover</em>
                                </div>
                                @error('cover')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="file" class="form-label">File Modul (PDF)</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                       id="file" name="file" accept=".pdf">
                                <div class="form-text">
                                    Format: PDF (Maks. 10MB)<br>
                                    <em>Kosongkan jika tidak ingin mengubah file</em>
                                </div>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Modul
                    </button>
                    <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Cover Saat Ini -->
        @if($modul->cover)
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">Cover Saat Ini</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('storage/modul/covers/' . $modul->cover) }}"
                     alt="{{ $modul->judul }}"
                     class="img-fluid rounded mb-2"
                     style="max-height: 200px;">
                <p class="text-muted small mb-0">{{ $modul->cover }}</p>
            </div>
        </div>
        @endif

        <!-- File Saat Ini -->
        @if($modul->file_path)
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">File Saat Ini</h5>
            </div>
            <div class="card-body text-center">
                <div class="bg-danger rounded d-flex align-items-center justify-content-center text-white mb-2"
                     style="height: 100px;">
                    <i class="fas fa-file-pdf fa-3x"></i>
                </div>
                <p class="text-muted small mb-2">{{ $modul->file_path }}</p>
                <a href="{{ asset('storage/modul/files/' . $modul->file_path) }}" 
                   class="btn btn-sm btn-outline-primary" target="_blank">
                    <i class="fas fa-download me-1"></i>Download
                </a>
            </div>
        </div>
        @endif

        <!-- Info Modul -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Informasi Modul</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>{{ $modul->kategori->nama ?? 'Tidak ada kategori' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $modul->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate:</strong></td>
                        <td>{{ $modul->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Cover:</strong></td>
                        <td>
                            @if($modul->cover)
                                <span class="badge bg-success">Ada</span>
                            @else
                                <span class="badge bg-secondary">Tidak Ada</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>File PDF:</strong></td>
                        <td>
                            @if($modul->file_path)
                                <span class="badge bg-success">Ada</span>
                            @else
                                <span class="badge bg-secondary">Tidak Ada</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection