@extends('admin.layouts.main')

@section('title', 'Detail Modul - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Detail Modul</h2>
        <p class="text-muted mb-0">Informasi lengkap modul pembelajaran</p>
    </div>
    <div>
        <a href="{{ route('admin.modul.edit', $modul) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Header Modul -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row">
                    @if($modul->cover)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/modul/covers/' . $modul->cover) }}"
                             alt="{{ $modul->judul }}"
                             class="img-fluid rounded">
                    </div>
                    <div class="col-md-9">
                    @else
                    <div class="col-12">
                    @endif
                        <h3 class="mb-3">{{ $modul->judul }}</h3>
                        <div class="mb-3">
                            @if($modul->kategori)
                                <span class="badge bg-primary me-2">{{ $modul->kategori->nama }}</span>
                            @endif
                            <span class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $modul->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <p class="text-muted mb-0">{{ $modul->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Modul -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Konten Modul</h5>
            </div>
            <div class="card-body">
                <div class="content-modul">
                    {!! $modul->konten !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- File Download -->
        @if($modul->file_path)
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">File Modul</h5>
            </div>
            <div class="card-body text-center">
                <div class="bg-danger rounded d-flex align-items-center justify-content-center text-white mb-3"
                     style="height: 100px;">
                    <i class="fas fa-file-pdf fa-3x"></i>
                </div>
                <h6 class="mb-2">File PDF Tersedia</h6>
                <p class="text-muted small mb-3">{{ $modul->file_path }}</p>
                <a href="{{ asset('storage/modul/files/' . $modul->file_path) }}" 
                   class="btn btn-primary" target="_blank">
                    <i class="fas fa-download me-2"></i>Download PDF
                </a>
            </div>
        </div>
        @endif

        <!-- Informasi Modul -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">Informasi Modul</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>
                            @if($modul->kategori)
                                <span class="badge bg-primary">{{ $modul->kategori->nama }}</span>
                            @else
                                <span class="text-muted">Tidak ada kategori</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Cover:</strong></td>
                        <td>
                            @if($modul->cover)
                                <span class="badge bg-success">Ada Cover</span>
                            @else
                                <span class="badge bg-secondary">Tidak Ada Cover</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>File PDF:</strong></td>
                        <td>
                            @if($modul->file_path)
                                <span class="badge bg-success">Ada File</span>
                            @else
                                <span class="badge bg-secondary">Tidak Ada File</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $modul->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate:</strong></td>
                        <td>{{ $modul->updated_at->format('d M Y H:i') }}</td>
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
                            <h6 class="text-muted">Karakter Deskripsi</h6>
                            <h4 class="text-primary">{{ strlen($modul->deskripsi) }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Kata Deskripsi</h6>
                        <h4 class="text-success">{{ str_word_count($modul->deskripsi) }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Karakter Konten</h6>
                            <h4 class="text-info">{{ strlen(strip_tags($modul->konten)) }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Kata Konten</h6>
                        <h4 class="text-warning">{{ str_word_count(strip_tags($modul->konten)) }}</h4>
                    </div>
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
                    <a href="{{ route('admin.modul.edit', $modul) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Modul
                    </a>
                    @if($modul->file_path)
                        <a href="{{ asset('storage/modul/files/' . $modul->file_path) }}" 
                           class="btn btn-info" target="_blank">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </a>
                    @endif
                    <a href="{{ route('frontend.modul.show', $modul) }}" 
                       class="btn btn-success" target="_blank">
                        <i class="fas fa-eye me-2"></i>Lihat di Frontend
                    </a>
                    <button type="button" class="btn btn-danger" 
                            onclick="deleteModul({{ $modul->id }})">
                        <i class="fas fa-trash me-2"></i>Hapus Modul
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

@push('styles')
<style>
.content-modul {
    line-height: 1.8;
}
.content-modul h1, .content-modul h2, .content-modul h3, 
.content-modul h4, .content-modul h5, .content-modul h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}
.content-modul p {
    margin-bottom: 1rem;
    text-align: justify;
}
.content-modul ul, .content-modul ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}
.content-modul img {
    max-width: 100%;
    height: auto;
    border-radius: 0.375rem;
    margin: 1rem 0;
}
.content-modul table {
    width: 100%;
    margin-bottom: 1rem;
    border-collapse: collapse;
}
.content-modul table th,
.content-modul table td {
    padding: 0.75rem;
    border: 1px solid #dee2e6;
}
.content-modul table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
</style>
@endpush

@push('scripts')
<script>
function deleteModul(modulId) {
    if (confirm('Apakah Anda yakin ingin menghapus modul ini?')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/modul/${modulId}`;
        form.submit();
    }
}
</script>
@endpush