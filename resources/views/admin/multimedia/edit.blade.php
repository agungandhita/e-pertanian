@extends('admin.layouts.main')

@section('title', 'Edit Multimedia - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Edit Multimedia</h2>
        <p class="text-muted mb-0">Ubah data multimedia</p>
    </div>
    <a href="{{ route('admin.multimedia.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Multimedia</h5>
            </div>
            <form action="{{ route('admin.multimedia.update', $multimedia) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror"
                                        id="kategori_id" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->kategori_id }}" 
                                                {{ (old('kategori_id') ?? $multimedia->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_media" class="form-label">Jenis Media <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis_media') is-invalid @enderror"
                                        id="jenis_media" name="jenis_media" required>
                                    <option value="">Pilih Jenis Media</option>
                                    <option value="video" {{ (old('jenis_media') ?? $multimedia->jenis_media) == 'video' ? 'selected' : '' }}>Video</option>
                                    <option value="gambar" {{ (old('jenis_media') ?? $multimedia->jenis_media) == 'gambar' ? 'selected' : '' }}>Gambar</option>
                                </select>
                                @error('jenis_media')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') ?? $multimedia->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- YouTube URL untuk Video -->
                    <div class="mb-3" id="youtube-section" style="display: {{ (old('jenis_media') ?? $multimedia->jenis_media) == 'video' ? 'block' : 'none' }};">
                        <label for="youtube_url" class="form-label">URL YouTube</label>
                        <input type="url" class="form-control @error('youtube_url') is-invalid @enderror"
                               id="youtube_url" name="youtube_url" value="{{ old('youtube_url') ?? $multimedia->youtube_url }}"
                               placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text">
                            Masukkan URL YouTube yang valid. Jika diisi, file video tidak perlu diupload.
                        </div>
                        @error('youtube_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div class="mb-3" id="file-section">
                        <label for="file" class="form-label">File Multimedia</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                               id="file" name="file">
                        <div class="form-text" id="file-help">
                            <strong>Format yang didukung:</strong><br>
                            • Video: MP4, AVI, MOV (Maks. 2MB)<br>
                            • Audio: MP3, WAV, OGG (Maks. 2MB)<br>
                            • Gambar: JPG, PNG, GIF (Maks. 2MB)<br>
                            • Infografis: JPG, PNG, PDF (Maks. 2MB)<br>
                            <em>Kosongkan jika tidak ingin mengubah file</em>
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Multimedia
                    </button>
                    <a href="{{ route('admin.multimedia.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Preview File Saat Ini -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">File Saat Ini</h5>
            </div>
            <div class="card-body text-center">
                @if($multimedia->file_path)
                    @if($multimedia->jenis_media == 'gambar' || $multimedia->jenis_media == 'infografis')
                        <img src="{{ asset('storage/multimedia/' . $multimedia->file_path) }}"
                             alt="{{ $multimedia->deskripsi }}"
                             class="img-fluid rounded mb-2"
                             style="max-height: 200px;">
                    @elseif($multimedia->jenis_media == 'video')
                        <video controls class="w-100 rounded mb-2" style="max-height: 200px;">
                            <source src="{{ asset('storage/multimedia/' . $multimedia->file_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    @elseif($multimedia->jenis_media == 'audio')
                        <div class="bg-success rounded d-flex align-items-center justify-content-center text-white mb-2"
                             style="height: 100px;">
                            <i class="fas fa-volume-up fa-3x"></i>
                        </div>
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/multimedia/' . $multimedia->file_path) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung audio.
                        </audio>
                    @endif
                    <p class="text-muted small mb-0">{{ $multimedia->file_path }}</p>
                @else
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                         style="height: 100px;">
                        <i class="fas fa-file fa-3x text-white"></i>
                    </div>
                    <p class="text-muted">Tidak ada file</p>
                @endif
            </div>
        </div>

        <!-- Info Multimedia -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Informasi Multimedia</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>{{ $multimedia->kategori->nama ?? 'Tidak ada kategori' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Media:</strong></td>
                        <td>
                            @if($multimedia->jenis_media == 'video')
                                <span class="badge bg-danger">Video</span>
                            @elseif($multimedia->jenis_media == 'audio')
                                <span class="badge bg-success">Audio</span>
                            @elseif($multimedia->jenis_media == 'gambar')
                                <span class="badge bg-info">Gambar</span>
                            @elseif($multimedia->jenis_media == 'infografis')
                                <span class="badge bg-warning">Infografis</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $multimedia->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate:</strong></td>
                        <td>{{ $multimedia->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Toggle YouTube section based on media type
document.getElementById('jenis_media').addEventListener('change', function() {
    const jenisMedia = this.value;
    const youtubeSection = document.getElementById('youtube-section');
    const youtubeInput = document.getElementById('youtube_url');
    
    if (jenisMedia === 'video') {
        youtubeSection.style.display = 'block';
    } else {
        youtubeSection.style.display = 'none';
        youtubeInput.value = '';
    }
});

// File validation
document.getElementById('file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
    const allowedTypes = ['video/mp4', 'video/avi', 'video/quicktime', 'image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    
    if (file) {
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 2MB.');
            e.target.value = '';
            return;
        }
        
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung!');
            e.target.value = '';
            return;
        }
    }
});
</script>
@endpush