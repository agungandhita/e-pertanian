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

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') ?? $multimedia->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- YouTube URL -->
                    <div class="mb-3">
                        <label for="youtube_url" class="form-label">URL YouTube <span class="text-danger">*</span></label>
                        <input type="url" class="form-control @error('youtube_url') is-invalid @enderror"
                               id="youtube_url" name="youtube_url" value="{{ old('youtube_url') ?? $multimedia->youtube_url }}" required
                               placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text">
                            Masukkan URL YouTube yang valid untuk video multimedia.
                        </div>
                        @error('youtube_url')
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
        <!-- Preview YouTube Video -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">Preview Video</h5>
            </div>
            <div class="card-body text-center">
                @if($multimedia->youtube_url)
                    @php
                        $videoId = null;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $multimedia->youtube_url, $matches)) {
                            $videoId = $matches[1];
                        }
                    @endphp
                    @if($videoId)
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" 
                                    title="YouTube video" 
                                    allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="bg-danger rounded d-flex align-items-center justify-content-center text-white"
                             style="height: 100px;">
                            <i class="fas fa-exclamation-triangle fa-3x"></i>
                        </div>
                        <p class="text-muted mt-2">URL YouTube tidak valid</p>
                    @endif
                @else
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                         style="height: 100px;">
                        <i class="fab fa-youtube fa-3x text-white"></i>
                    </div>
                    <p class="text-muted">Belum ada URL YouTube</p>
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
$(document).ready(function() {
    // Validasi form sebelum submit
    $('form').submit(function(e) {
        const kategoriId = $('#kategori_id').val();
        const deskripsi = $('#deskripsi').val().trim();
        const youtubeUrl = $('#youtube_url').val().trim();
        
        if (!kategoriId) {
            alert('Silakan pilih kategori!');
            e.preventDefault();
            return;
        }
        
        if (!deskripsi) {
            alert('Silakan isi deskripsi!');
            e.preventDefault();
            return;
        }
        
        if (!youtubeUrl) {
            alert('Silakan isi URL YouTube!');
            e.preventDefault();
            return;
        }
    });
});
</script>
@endpush
