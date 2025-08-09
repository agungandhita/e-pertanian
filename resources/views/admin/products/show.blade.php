@extends('admin.layouts.main')

@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Produk</h3>
                    <div class="btn-group">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri - Gambar -->
                        <div class="col-md-4">
                            <div class="text-center">
                                @if($product->gambar)
                                    <img src="{{ asset('storage/products/' . $product->gambar) }}" 
                                         alt="{{ $product->nama }}" 
                                         class="img-fluid rounded shadow" 
                                         style="max-height: 400px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="height: 300px;">
                                        <div class="text-center">
                                            <i class="fas fa-image fa-5x text-muted mb-3"></i>
                                            <p class="text-muted">Tidak ada gambar</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Kolom Kanan - Detail -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-3">{{ $product->nama }}</h4>
                                    
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold" style="width: 120px;">Kategori:</td>
                                            <td>
                                                <span class="badge bg-info fs-6">{{ $product->kategori->nama ?? 'Tidak ada kategori' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Harga:</td>
                                            <td class="text-success fw-bold fs-5">
                                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Stok:</td>
                                            <td>
                                                <span class="badge {{ $product->stok > 10 ? 'bg-success' : ($product->stok > 0 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                                    {{ $product->stok }} {{ $product->satuan }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Satuan:</td>
                                            <td>{{ ucfirst($product->satuan) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Status:</td>
                                            <td>
                                                @if($product->status == 'aktif')
                                                    <span class="badge bg-success fs-6">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger fs-6">Non-aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Dibuat:</td>
                                            <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Diperbarui:</td>
                                            <td>{{ $product->updated_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <!-- Statistik Penjualan -->
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <i class="fas fa-chart-line me-2"></i>Statistik Penjualan
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <div class="border-end">
                                                        <h5 class="text-primary mb-1">{{ $product->orderItems->sum('quantity') ?? 0 }}</h5>
                                                        <small class="text-muted">Total Terjual</small>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="text-success mb-1">
                                                        Rp {{ number_format(($product->orderItems->sum('quantity') ?? 0) * $product->harga, 0, ',', '.') }}
                                                    </h5>
                                                    <small class="text-muted">Total Pendapatan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quick Actions -->
                                    <div class="card bg-light mt-3">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <i class="fas fa-tools me-2"></i>Aksi Cepat
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit me-2"></i>Edit Produk
                                                </a>
                                                @if($product->stok <= 5)
                                                    <button class="btn btn-info btn-sm" onclick="updateStock()">
                                                        <i class="fas fa-plus me-2"></i>Tambah Stok
                                                    </button>
                                                @endif
                                                <a href="{{ route('frontend.products.show', $product) }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                                    <i class="fas fa-external-link-alt me-2"></i>Lihat di Frontend
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-align-left me-2"></i>Deskripsi Produk
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0" style="white-space: pre-line;">{{ $product->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Pesanan -->
                    @if($product->orderItems->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-history me-2"></i>Riwayat Pesanan ({{ $product->orderItems->count() }} pesanan)
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No. Pesanan</th>
                                                    <th>Pembeli</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($product->orderItems->take(10) as $orderItem)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $orderItem->order) }}" class="text-decoration-none">
                                                            #{{ $orderItem->order->order_number }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $orderItem->order->user->name }}</td>
                                                    <td>{{ $orderItem->quantity }} {{ $product->satuan }}</td>
                                                    <td>Rp {{ number_format($orderItem->price, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') }}</td>
                                                    <td>{{ $orderItem->order->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $orderItem->order->status == 'completed' ? 'success' : ($orderItem->order->status == 'pending' ? 'warning' : 'info') }}">
                                                            {{ ucfirst($orderItem->order->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($product->orderItems->count() > 10)
                                        <div class="text-center mt-3">
                                            <small class="text-muted">Menampilkan 10 pesanan terbaru dari {{ $product->orderItems->count() }} total pesanan</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Stock -->
<div class="modal fade" id="updateStockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Stok Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                                        <label for="current_stock" class="form-label">Stok Saat Ini</label>
                                        <input type="text" class="form-control" id="current_stock" value="{{ $product->stok }} {{ $product->satuan }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_stock" class="form-label">Stok Baru</label>
                                        <input type="number" class="form-control" id="new_stock" name="stok" value="{{ $product->stok }}" min="0" required>
                                    </div>
                    <!-- Hidden fields untuk data lain -->
                                    <input type="hidden" name="nama" value="{{ $product->nama }}">
                                    <input type="hidden" name="kategori_id" value="{{ $product->kategori_id }}">
                                    <input type="hidden" name="harga" value="{{ $product->harga }}">
                                    <input type="hidden" name="satuan" value="{{ $product->satuan }}">
                                    <input type="hidden" name="deskripsi" value="{{ $product->deskripsi }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Stok</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateStock() {
    var modal = new bootstrap.Modal(document.getElementById('updateStockModal'));
    modal.show();
}
</script>
@endpush