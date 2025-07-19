@extends('admin.layouts.main')

@section('title', 'Detail Berita - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Detail Berita</h2>
        <p class="text-muted mb-0">Informasi lengkap berita</p>
    </div>
    <div>
        <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                @if($berita->gambar)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                             class="img-fluid rounded"
                             alt="{{ $berita->judul }}"
                             style="max-height: 400px; object-fit: cover;">
                    </div>
                @endif

                <h1 class="h3 mb-3">{{ $berita->judul }}</h1>
                
                <div class="mb-3">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>
                        Dipublikasikan pada {{ $berita->created_at->format('d F Y, H:i') }}
                        @if($berita->updated_at != $berita->created_at)
                            <br>
                            <i class="fas fa-edit me-1"></i>
                            Terakhir diupdate {{ $berita->updated_at->format('d F Y, H:i') }}
                        @endif
                    </small>
                </div>

                <hr>

                <div class="content">
                    {!! $berita->isi !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Berita
                    </a>
                    <button type="button" class="btn btn-danger" onclick="deleteBerita({{ $berita->id }})">
                        <i class="fas fa-trash me-2"></i>Hapus Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>Daftar Berita
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-3">
            <div class="card-header">
                <h5 class="mb-0">Informasi</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Judul:</small><br>
                    <span>{{ $berita->judul }}</span>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Jumlah Karakter:</small><br>
                    <span class="badge bg-info">{{ strlen(strip_tags($berita->isi)) }} karakter</span>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Jumlah Kata:</small><br>
                    <span class="badge bg-success">{{ str_word_count(strip_tags($berita->isi)) }} kata</span>
                </div>

                @if($berita->gambar)
                <div class="mb-3">
                    <small class="text-muted">Gambar:</small><br>
                    <span class="badge bg-primary">Ada gambar</span>
                </div>
                @else
                <div class="mb-3">
                    <small class="text-muted">Gambar:</small><br>
                    <span class="badge bg-secondary">Tidak ada gambar</span>
                </div>
                @endif

                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    <span>{{ $berita->created_at->format('d M Y H:i') }}</span>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Update:</small><br>
                    <span>{{ $berita->updated_at->format('d M Y H:i') }}</span>
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
function deleteBerita(beritaId) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini? Data yang dihapus tidak dapat dikembalikan.')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/berita/${beritaId}`;
        form.submit();
    }
}
</script>
@endpush