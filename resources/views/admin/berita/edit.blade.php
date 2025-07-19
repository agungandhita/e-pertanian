@extends('admin.layouts.main')

@section('title', 'Edit Berita - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Edit Berita</h2>
        <p class="text-muted mb-0">Ubah informasi berita</p>
    </div>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Berita</h5>
            </div>
            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control froala-editor @error('isi') is-invalid @enderror"
                                  id="isi" name="isi" rows="10" required>{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Berita</label>
                        @if($berita->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                                     alt="{{ $berita->judul }}"
                                     class="img-thumbnail"
                                     style="max-width: 200px; max-height: 150px; object-fit: cover;">
                                <p class="text-muted small mt-1">Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                               id="gambar" name="gambar" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF. Maksimal 2MB</div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Berita
                    </button>
                    <a href="{{ route('admin.berita.show', $berita) }}" class="btn btn-info">
                        <i class="fas fa-eye me-2"></i>Lihat Detail
                    </a>
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
                <h5 class="mb-0">Informasi Berita</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                             alt="{{ $berita->judul }}"
                             class="img-fluid rounded"
                             style="max-width: 150px; max-height: 100px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded mx-auto"
                             style="width: 150px; height: 100px;">
                            <i class="fas fa-image fa-2x text-muted"></i>
                        </div>
                    @endif
                    <h6 class="mt-2">{{ $berita->judul }}</h6>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    <span>{{ $berita->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Terakhir diupdate:</small><br>
                    <span>{{ $berita->updated_at->format('d M Y H:i') }}</span>
                </div>

                <hr>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Perubahan akan langsung terlihat di halaman publik.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection