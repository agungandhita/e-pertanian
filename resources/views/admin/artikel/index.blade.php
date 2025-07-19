@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Manajemen Artikel</h4>
                    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Artikel
                    </a>
                </div>
                <div class="card-body">
                    @if($artikels->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Gambar</th>
                                        <th width="25%">Judul</th>
                                        <th width="35%">Deskripsi</th>
                                        <th width="10%">Tanggal</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($artikels as $index => $artikel)
                                    <tr>
                                        <td>{{ $artikels->firstItem() + $index }}</td>
                                        <td>
                                            @if($artikel->gambar)
                                                <img src="{{ $artikel->gambar_url }}" alt="{{ $artikel->judul }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $artikel->judul }}</strong>
                                        </td>
                                        <td>
                                            {{ Str::limit($artikel->deskripsi, 100) }}
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $artikel->created_at->format('d/m/Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.artikel.show', $artikel) }}" class="btn btn-sm btn-info" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.artikel.destroy', $artikel) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
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
                            {{ $artikels->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada artikel</h5>
                            <p class="text-muted">Klik tombol "Tambah Artikel" untuk menambahkan artikel pertama.</p>
                            <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Artikel
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection