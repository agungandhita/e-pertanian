@extends('admin.layouts.main')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detail Pesanan #{{ $order->order_number }}</h3>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Kolom Kiri - Info Pesanan -->
                        <div class="col-md-8">
                            <!-- Info Umum -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Informasi Pesanan
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="fw-bold" style="width: 150px;">No. Pesanan:</td>
                                                    <td>#{{ $order->order_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Tanggal Pesanan:</td>
                                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Status:</td>
                                                    <td>
                                                        <span class="badge bg-{{
                                                            $order->status == 'pending' ? 'warning' :
                                                            ($order->status == 'paid' ? 'info' :
                                                            ($order->status == 'processing' ? 'primary' :
                                                            ($order->status == 'shipped' ? 'secondary' :
                                                            ($order->status == 'delivered' ? 'success' :
                                                            ($order->status == 'cancelled' ? 'danger' : 'secondary')))))
                                                        }} fs-6">
                                                            @if($order->status == 'pending')
                                                                Pending
                                                            @elseif($order->status == 'paid')
                                                                Dibayar
                                                            @elseif($order->status == 'processing')
                                                                Diproses
                                                            @elseif($order->status == 'shipped')
                                                                Dikirim
                                                            @elseif($order->status == 'delivered')
                                                                Diterima
                                                            @elseif($order->status == 'cancelled')
                                                                Dibatalkan
                                                            @else
                                                                {{ ucfirst($order->status) }}
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Metode Pembayaran:</td>
                                                    <td>{{ strtoupper($order->payment_method) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="fw-bold" style="width: 150px;">Total Pembayaran:</td>
                                                    <td class="text-success fw-bold fs-5">
                                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Status Pembayaran:</td>
                                                    <td>
                                                        @if($order->payment_proof)
                                                            <span class="badge bg-success fs-6">Sudah Upload Bukti</span>
                                                        @else
                                                            <span class="badge bg-warning fs-6">Belum Upload Bukti</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Diperbarui:</td>
                                                    <td>{{ $order->updated_at->format('d M Y, H:i') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Pembeli -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-user me-2"></i>Informasi Pembeli
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="fw-bold" style="width: 120px;">Nama:</td>
                                                    <td>{{ $order->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Email:</td>
                                                    <td>{{ $order->user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Telepon:</td>
                                                    <td>{{ $order->phone ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td class="fw-bold" style="width: 120px;">Alamat:</td>
                                                    <td>{{ $order->shipping_address ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Catatan:</td>
                                                    <td>{{ $order->notes ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Produk -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-shopping-bag me-2"></i>Daftar Produk ({{ $order->orderItems->count() }} item)
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Jumlah</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->orderItems as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($item->product->gambar)
                                                                <img src="{{ asset('storage/products/' . $item->product->gambar) }}"
                                                                     alt="{{ $item->product->nama }}"
                                                                     class="img-thumbnail me-3"
                                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-light d-flex align-items-center justify-content-center me-3"
                                                                     style="width: 50px; height: 50px; border-radius: 4px;">
                                                                    <i class="fas fa-image text-muted"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <strong>{{ $item->product->nama }}</strong>
                                                                <br>
                                                                <small class="text-muted">{{ $item->product->kategori->nama_kategori ?? '-' }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                    <td>{{ $item->quantity }} {{ $item->product->satuan }}</td>
                                                    <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="table-dark">
                                                    <th colspan="3" class="text-end">Total:</th>
                                                    <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Aksi & Bukti Pembayaran -->
                        <div class="col-md-4">
                            <!-- Aksi Cepat -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-tools me-2"></i>Aksi Cepat
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        @if($order->status == 'pending')
                                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="paid">
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Yakin ingin mengubah status menjadi Dibayar?')">
                                                    <i class="fas fa-check me-2"></i>Tandai Dibayar
                                                </button>
                                            </form>
                                        @endif

                                        @if($order->status == 'paid')
                                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="processing">
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mengubah status menjadi Diproses?')">
                                                    <i class="fas fa-cog me-2"></i>Mulai Proses
                                                </button>
                                            </form>
                                        @endif

                                        @if($order->status == 'processing')
                                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="shipped">
                                                <button type="submit" class="btn btn-info" onclick="return confirm('Yakin ingin mengubah status menjadi Dikirim?')">
                                                    <i class="fas fa-truck me-2"></i>Kirim Pesanan
                                                </button>
                                            </form>
                                        @endif

                                        @if($order->status == 'shipped')
                                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="delivered">
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Yakin ingin mengubah status menjadi Diterima?')">
                                                    <i class="fas fa-check-circle me-2"></i>Tandai Diterima
                                                </button>
                                            </form>
                                        @endif



                                        <a href="{{ route('frontend.orders.invoice', $order) }}" class="btn btn-outline-primary" target="_blank">
                                            <i class="fas fa-file-pdf me-2"></i>Cetak Invoice
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Status -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-history me-2"></i>Timeline Status
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <div class="timeline-item {{ $order->status == 'pending' ? 'active' : 'completed' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Pesanan Dibuat</h6>
                                                <small>{{ $order->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>

                                        @if(in_array($order->status, ['paid', 'processing', 'shipped', 'delivered']))
                                        <div class="timeline-item {{ $order->status == 'paid' ? 'active' : 'completed' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Dibayar</h6>
                                                <small>{{ $order->updated_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                        @endif

                                        @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                        <div class="timeline-item {{ $order->status == 'processing' ? 'active' : 'completed' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Diproses</h6>
                                                <small>{{ $order->updated_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                        @endif

                                        @if(in_array($order->status, ['shipped', 'delivered']))
                                        <div class="timeline-item {{ $order->status == 'shipped' ? 'active' : 'completed' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Dikirim</h6>
                                                <small>{{ $order->updated_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                        @endif

                                        @if($order->status == 'delivered')
                                        <div class="timeline-item completed">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Diterima</h6>
                                                <small>{{ $order->updated_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Bukti Pembayaran -->
                            @if($order->payment_proof)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-receipt me-2"></i>Bukti Pembayaran
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ $order->payment_proof_url }}"
                                         alt="Bukti Pembayaran"
                                         class="img-fluid rounded"
                                         style="max-height: 300px; cursor: pointer;"
                                         onclick="showImageModal(this.src)">
                                    <div class="mt-3">
                                        <a href="{{ $order->payment_proof_url }}"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="fas fa-external-link-alt me-2"></i>Lihat Full Size
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk melihat gambar -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Bukti Pembayaran" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #dee2e6;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-item.active .timeline-marker {
    background: #ffc107;
    box-shadow: 0 0 0 2px #ffc107;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    box-shadow: 0 0 0 2px #28a745;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-weight: 600;
}

.timeline-content small {
    color: #6c757d;
}
</style>
@endpush

@push('scripts')
<script>


function showImageModal(src) {
    document.getElementById('modalImage').src = src;
    var modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Auto hide alerts after 5 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);
</script>
@endpush
