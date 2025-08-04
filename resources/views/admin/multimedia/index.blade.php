@extends('admin.layouts.main')

@section('title', 'Kelola Multimedia - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Kelola Multimedia</h2>
        <p class="text-muted mb-0">Manajemen data multimedia</p>
    </div>
    <a href="{{ route('admin.multimedia.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Multimedia
    </a>
</div>

<!-- Tabel Multimedia -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Multimedia</h6>
    </div>
    <div class="card-body">
        @if($multimedia->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($multimedia as $index => $item)
                        <tr>
                            <td>{{ $multimedia->firstItem() + $index }}</td>
                            <td>
                                @if($item->youtube_url)
                                    <div class="bg-danger rounded d-flex align-items-center justify-content-center text-white position-relative"
                                         style="width: 60px; height: 40px;">
                                        <i class="fab fa-youtube"></i>
                                        <small class="position-absolute" style="bottom: -2px; right: -2px; font-size: 8px;">YT</small>
                                    </div>
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                         style="width: 60px; height: 40px;">
                                        <i class="fab fa-youtube text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $item->kategori->nama ?? 'Tidak ada kategori' }}</span>
                            </td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>
                                <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.multimedia.show', $item) }}"
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.multimedia.edit', $item) }}"
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="deleteMultimedia({{ $item->id }})" title="Hapus">
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
                    Menampilkan {{ $multimedia->firstItem() }} - {{ $multimedia->lastItem() }} dari {{ $multimedia->total() }} multimedia
                </div>
                {{ $multimedia->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-photo-video fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak ada multimedia ditemukan</h5>
                <p class="text-muted">Belum ada data multimedia</p>
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
function deleteMultimedia(multimediaId) {
    if (confirm('Apakah Anda yakin ingin menghapus multimedia ini?')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/multimedia/${multimediaId}`;
        form.submit();
    }
}
</script>
@endpush