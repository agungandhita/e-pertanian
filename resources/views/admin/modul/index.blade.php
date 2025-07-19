@extends('admin.layouts.main')

@section('title', 'Kelola Modul - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Kelola Modul</h2>
        <p class="text-muted mb-0">Manajemen data modul pembelajaran</p>
    </div>
    <a href="{{ route('admin.modul.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Modul
    </a>
</div>

<!-- Tabel Modul -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Modul</h6>
    </div>
    <div class="card-body">
        @if($moduls->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($moduls as $index => $modul)
                        <tr>
                            <td>{{ $moduls->firstItem() + $index }}</td>
                            <td>
                                @if($modul->cover)
                                    <img src="{{ asset('storage/modul/covers/' . $modul->cover) }}"
                                         alt="{{ $modul->judul }}"
                                         class="rounded"
                                         width="60" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                         style="width: 60px; height: 40px;">
                                        <i class="fas fa-book text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ Str::limit($modul->judul, 30) }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $modul->kategori->nama ?? 'Tidak ada kategori' }}</span>
                            </td>
                            <td>{{ Str::limit($modul->deskripsi, 50) }}</td>
                            <td>
                                @if($modul->file_path)
                                    <span class="badge bg-success">
                                        <i class="fas fa-file-pdf me-1"></i>Ada File
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-times me-1"></i>Tidak Ada
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $modul->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.modul.show', $modul) }}"
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.modul.edit', $modul) }}"
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="deleteModul({{ $modul->id }})" title="Hapus">
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
                    Menampilkan {{ $moduls->firstItem() }} - {{ $moduls->lastItem() }} dari {{ $moduls->total() }} modul
                </div>
                {{ $moduls->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak ada modul ditemukan</h5>
                <p class="text-muted">Belum ada data modul pembelajaran</p>
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
function deleteModul(modulId) {
    if (confirm('Apakah Anda yakin ingin menghapus modul ini?')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/modul/${modulId}`;
        form.submit();
    }
}
</script>
@endpush