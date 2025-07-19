@extends('admin.layouts.main')

@section('title', 'Tambah Berita - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Tambah Berita Baru</h2>
        <p class="text-muted mb-0">Buat berita baru</p>
    </div>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Berita</h5>
            </div>
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control froala-editor @error('isi') is-invalid @enderror"
                                  id="isi" name="isi" rows="10" required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Berita</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                               id="gambar" name="gambar" accept="image/*">
                        <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Panduan</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Judul berita harus jelas dan menarik</li>
                        <li>Isi berita dapat menggunakan format rich text</li>
                        <li>Gambar berita opsional</li>
                        <li>Pastikan konten berita akurat dan terpercaya</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection