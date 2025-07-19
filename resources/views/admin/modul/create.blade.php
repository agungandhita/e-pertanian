@extends('admin.layouts.main')

@section('title', 'Tambah Modul - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Tambah Modul Baru</h2>
        <p class="text-muted mb-0">Buat modul pembelajaran baru</p>
    </div>
    <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Modul</h5>
            </div>
            <form action="{{ route('admin.modul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Modul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" value="{{ old('judul') }}" required>
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
                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
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
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten Modul <span class="text-danger">*</span></label>
                        <textarea class="form-control froala-editor @error('konten') is-invalid @enderror"
                                  id="konten" name="konten" rows="10" required>{{ old('konten') }}</textarea>
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
                                <div class="form-text">Format: JPG, PNG, GIF (Maks. 2MB)</div>
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
                                <div class="form-text">Format: PDF (Maks. 10MB)</div>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Modul
                    </button>
                    <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Panduan Modul</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Tips Membuat Modul:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Gunakan judul yang jelas dan menarik</li>
                        <li>Pilih kategori yang sesuai</li>
                        <li>Tulis deskripsi singkat namun informatif</li>
                        <li>Buat konten yang mudah dipahami</li>
                        <li>Upload cover yang menarik</li>
                        <li>Sertakan file PDF jika diperlukan</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Pastikan konten sesuai dengan kategori</li>
                        <li>Gunakan bahasa yang mudah dipahami</li>
                        <li>File yang diupload akan tersedia untuk publik</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection