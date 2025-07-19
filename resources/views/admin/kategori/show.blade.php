@extends('admin.layouts.main')

@section('title', 'Detail Kategori - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Detail Kategori</h2>
        <p class="text-muted mb-0">Informasi lengkap kategori</p>
    </div>
    <div>
        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Informasi Kategori -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Informasi Kategori</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Nama Kategori:</strong>
                    </div>
                    <div class="col-md-9">
                        <h4 class="text-primary">{{ $kategori->nama }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <strong>Dibuat pada:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $kategori->created_at->format('d M Y H:i:s') }}
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-3">
                        <strong>Terakhir diupdate:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $kategori->updated_at->format('d M Y H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Statistik Kategori -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h5 class="mb-0">Statistik Kategori</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Total Artikel</h6>
                            <h4 class="text-primary">{{ $kategori->artikels->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Total Berita</h6>
                        <h4 class="text-success">{{ $kategori->beritas->count() }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-muted">Total Multimedia</h6>
                            <h4 class="text-info">{{ $kategori->multimedias->count() }}</h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted">Total Modul</h6>
                        <h4 class="text-warning">{{ $kategori->moduls->count() }}</h4>
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
                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Kategori
                    </a>
                    <button type="button" class="btn btn-danger" 
                            onclick="deleteKategori({{ $kategori->kategori_id }})">
                        <i class="fas fa-trash me-2"></i>Hapus Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Konten Terkait -->
@if($kategori->artikels->count() > 0 || $kategori->beritas->count() > 0 || $kategori->multimedias->count() > 0 || $kategori->moduls->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Konten Terkait</h5>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="contentTab" role="tablist">
                    @if($kategori->artikels->count() > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="artikel-tab" data-bs-toggle="tab" data-bs-target="#artikel" type="button" role="tab">
                            Artikel ({{ $kategori->artikels->count() }})
                        </button>
                    </li>
                    @endif
                    @if($kategori->beritas->count() > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $kategori->artikels->count() == 0 ? 'active' : '' }}" id="berita-tab" data-bs-toggle="tab" data-bs-target="#berita" type="button" role="tab">
                            Berita ({{ $kategori->beritas->count() }})
                        </button>
                    </li>
                    @endif
                    @if($kategori->multimedias->count() > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $kategori->artikels->count() == 0 && $kategori->beritas->count() == 0 ? 'active' : '' }}" id="multimedia-tab" data-bs-toggle="tab" data-bs-target="#multimedia" type="button" role="tab">
                            Multimedia ({{ $kategori->multimedias->count() }})
                        </button>
                    </li>
                    @endif
                    @if($kategori->moduls->count() > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $kategori->artikels->count() == 0 && $kategori->beritas->count() == 0 && $kategori->multimedias->count() == 0 ? 'active' : '' }}" id="modul-tab" data-bs-toggle="tab" data-bs-target="#modul" type="button" role="tab">
                            Modul ({{ $kategori->moduls->count() }})
                        </button>
                    </li>
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-3" id="contentTabContent">
                    @if($kategori->artikels->count() > 0)
                    <div class="tab-pane fade show active" id="artikel" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori->artikels->take(5) as $artikel)
                                    <tr>
                                        <td>{{ Str::limit($artikel->judul, 50) }}</td>
                                        <td>{{ $artikel->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.artikel.show', $artikel) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($kategori->beritas->count() > 0)
                    <div class="tab-pane fade {{ $kategori->artikels->count() == 0 ? 'show active' : '' }}" id="berita" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori->beritas->take(5) as $berita)
                                    <tr>
                                        <td>{{ Str::limit($berita->judul, 50) }}</td>
                                        <td>{{ $berita->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.berita.show', $berita) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($kategori->multimedias->count() > 0)
                    <div class="tab-pane fade {{ $kategori->artikels->count() == 0 && $kategori->beritas->count() == 0 ? 'show active' : '' }}" id="multimedia" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <th>Jenis</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori->multimedias->take(5) as $multimedia)
                                    <tr>
                                        <td>{{ Str::limit($multimedia->deskripsi, 50) }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst($multimedia->jenis_media) }}</span>
                                        </td>
                                        <td>{{ $multimedia->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.multimedia.show', $multimedia) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($kategori->moduls->count() > 0)
                    <div class="tab-pane fade {{ $kategori->artikels->count() == 0 && $kategori->beritas->count() == 0 && $kategori->multimedias->count() == 0 ? 'show active' : '' }}" id="modul" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori->moduls->take(5) as $modul)
                                    <tr>
                                        <td>{{ Str::limit($modul->judul, 50) }}</td>
                                        <td>{{ $modul->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.modul.show', $modul) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Form Delete (Hidden) -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function deleteKategori(kategoriId) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua konten terkait akan kehilangan kategori.')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/kategori/${kategoriId}`;
        form.submit();
    }
}
</script>
@endpush