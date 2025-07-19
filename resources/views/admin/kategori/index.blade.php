@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Manajemen Kategori</h4>
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </a>
                </div>
                <div class="card-body">
                    @if($kategoris->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="40%">Nama Kategori</th>
                                        <th width="20%">Jumlah Multimedia</th>
                                        <th width="20%">Jumlah Modul</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategoris as $index => $kategori)
                                    <tr>
                                        <td>{{ $kategoris->firstItem() + $index }}</td>
                                        <td>
                                            <strong>{{ $kategori->nama }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $kategori->multimedia->count() }} item</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $kategori->moduls->count() }} modul</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $kategoris->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada kategori</h5>
                            <p class="text-muted">Klik tombol "Tambah Kategori" untuk menambahkan kategori pertama.</p>
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Kategori
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection