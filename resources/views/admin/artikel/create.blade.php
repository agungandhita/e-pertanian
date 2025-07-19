@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Tambah Artikel</h4>
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" name="judul" value="{{ old('judul') }}" 
                                           placeholder="Masukkan judul artikel" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" rows="8" 
                                              placeholder="Masukkan deskripsi artikel" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar Artikel</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                           id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                                </div>
                                
                                <!-- Preview Gambar -->
                                <div class="mb-3">
                                    <div id="image-preview" class="border rounded p-3 text-center" style="min-height: 200px; display: none;">
                                        <img id="preview-img" src="" alt="Preview" class="img-fluid" style="max-height: 180px;">
                                    </div>
                                    <div id="no-image" class="border rounded p-3 text-center bg-light" style="min-height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Preview gambar akan muncul di sini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Artikel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const file = input.files[0];
    const preview = document.getElementById('preview-img');
    const imagePreview = document.getElementById('image-preview');
    const noImage = document.getElementById('no-image');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block';
            noImage.style.display = 'none';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        imagePreview.style.display = 'none';
        noImage.style.display = 'block';
    }
}
</script>
@endpush