@extends('admin.layouts.main')

@section('title', 'Kelola Berita - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Kelola Berita</h2>
        <p class="text-muted mb-0">Manajemen data berita</p>
    </div>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Berita
    </a>
</div>

<!-- Tabel Berita -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
    </div>
    <div class="card-body">
        @if($berita->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berita as $index => $item)
                        <tr>
                            <td>{{ $berita->firstItem() + $index }}</td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/berita/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="rounded"
                                         width="60" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                         style="width: 60px; height: 40px;">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ Str::limit($item->judul, 50) }}</div>
                            </td>
                            <td>{{ Str::limit(strip_tags($item->isi), 100) }}</td>
                            <td>
                                <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.berita.show', $item) }}"
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $item) }}"
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="deleteBerita({{ $item->id }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $berita->firstItem() }} - {{ $berita->lastItem() }} dari {{ $berita->total() }} berita
                </div>
                {{ $berita->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak ada berita ditemukan</h5>
                <p class="text-muted">Belum ada data berita</p>
            </div>
        @endif
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
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/berita/${beritaId}`;
        form.submit();
    }
}
</script>
@endpush