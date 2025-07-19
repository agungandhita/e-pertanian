@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Edit Kategori</h4>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" 
                                           placeholder="Masukkan nama kategori" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Contoh: Tanaman Pangan, Hortikultura, Peternakan, dll.</small>
                                </div>
                                
                                <!-- Info Penggunaan -->
                                <div class="alert alert-info">
                                    <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Informasi Penggunaan</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <small>
                                                <strong>Multimedia:</strong> {{ $kategori->multimedia->count() }} item
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small>
                                                <strong>Modul:</strong> {{ $kategori->moduls->count() }} modul
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Kategori
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection