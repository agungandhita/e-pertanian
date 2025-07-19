@extends('admin.layouts.main')

@section('title', 'Detail Multimedia - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Detail Multimedia</h2>
        <p class="text-muted mb-0">Informasi lengkap multimedia</p>
    </div>
    <div>
        <a href="{{ route('admin.multimedia.edit', $multimedia) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.multimedia.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Preview Multimedia -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Preview Multimedia</h5>
            </div>
            <div class="card-body text-center">
                @if($multimedia->youtube_url && $multimedia->jenis_media == 'video')
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ str_replace('watch?v=', 'embed/', $multimedia->youtube_url) }}" 
                                title="YouTube video" 
                                allowfullscreen 
                                class="rounded">
                        </iframe>
                    </div>
                @elseif($multimedia->file_path)
                    @if($multimedia->jenis_media == 'gambar' || $multimedia->jenis_media == 'infografis')
                        <img src="{{ asset('storage/multimedia/' . $multimedia->file_path) }}"
                             alt="{{ $multimedia->deskripsi }}"
                             class="img-fluid rounded"
                             style="max-height: 400px;">
                    @elseif($multimedia->jenis_media == 'video')
                        <video controls class="w-100 rounded" style="max-height: 400px;">
                            <source src="{{ asset('storage/multimedia/' . $multimedia->file_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    @elseif($multimedia->jenis_media == 'audio')
                        <div class="bg-success rounded d-flex align-items-center justify-content-center text-white mb-3"
                             style="height: 200px;">
                            <i class="fas fa-volume-up fa-5x"></i>
                        </div>
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/multimedia/' . $multimedia->file_path) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung audio.
                        </audio>
                    @endif
                @else
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                         style="height: 200px;">
                        <i class="fas fa-file fa-5x text-white"></i>
                    </div>
                    <p class="text-muted mt-3">Tidak ada file multimedia</p>
                @endif
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Deskripsi</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $multimedia->deskripsi }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Informasi Multimedia -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">Informasi Multimedia</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>
                            @if($multimedia->kategori)
                                <span class="badge bg-primary">{{ $multimedia->kategori->nama }}</span>
                            @else
                                <span class="text-muted">Tidak ada kategori</span>
                            @endif
                        </td>
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
                        <td><strong>File:</strong></td>
                        <td>
                            @if($multimedia->file_path)
                                <small class="text-muted">{{ $multimedia->file_path }}</small>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                    </tr>
                    @if($multimedia->youtube_url)
                    <tr>
                        <td><strong>YouTube URL:</strong></td>
                        <td>
                            <a href="{{ $multimedia->youtube_url }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-youtube text-danger me-1"></i>
                                <small>Lihat di YouTube</small>
                            </a>
                        </td>
                    </tr>
                    @endif
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

        <!-- Statistik -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">Statistik</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Karakter</h6>
                            <h4 class="text-primary">{{ strlen($multimedia->deskripsi) }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Kata</h6>
                        <h4 class="text-success">{{ str_word_count($multimedia->deskripsi) }}</h4>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <h6 class="text-muted">Status File</h6>
                    @if($multimedia->file_path && file_exists(storage_path('app/public/multimedia/' . $multimedia->file_path)))
                        <span class="badge bg-success">File Tersedia</span>
                    @else
                        <span class="badge bg-danger">File Tidak Ditemukan</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Aksi -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.multimedia.edit', $multimedia) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Multimedia
                    </a>
                    @if($multimedia->file_path)
                        <a href="{{ asset('storage/multimedia/' . $multimedia->file_path) }}" 
                           class="btn btn-info" target="_blank">
                            <i class="fas fa-download me-2"></i>Download File
                        </a>
                    @endif
                    <button type="button" class="btn btn-danger" 
                            onclick="deleteMultimedia({{ $multimedia->id }})">
                        <i class="fas fa-trash me-2"></i>Hapus Multimedia
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Delete (Hidden) -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function deleteMultimedia(multimediaId) {
    if (confirm('Apakah Anda yakin ingin menghapus multimedia ini?')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/multimedia/${multimediaId}`;
        form.submit();
    }
}
</script>
@endpush