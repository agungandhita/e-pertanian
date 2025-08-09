@extends('admin.layouts.main')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Produk</h3>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filter dan Search -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('admin.products.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                           placeholder="Cari produk..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('admin.products.index') }}">
                                <div class="input-group">
                                    <select name="kategori_id" class="form-select">
                                        <option value="">Semua Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->kategori_id }}" {{ request('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('admin.products.index') }}">
                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $index => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $index }}</td>
                                    <td>
                                        @if($product->gambar)
                                            <img src="{{ asset('storage/products/' . $product->gambar) }}"
                                                 alt="{{ $product->nama }}"
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px; border-radius: 4px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $product->nama }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($product->deskripsi, 50) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $product->kategori->nama ?? 'Tidak ada kategori' }}</span>
                                    </td>
                                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $product->stok > 10 ? 'bg-success' : ($product->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $product->stok }} {{ $product->satuan }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non-aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.show', $product) }}"
                                               class="btn btn-sm btn-info" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada produk yang tersedia</p>
                                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah Produk Pertama
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush
