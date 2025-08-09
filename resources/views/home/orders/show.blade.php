@extends('home.layouts.main')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('container')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Detail Pesanan #{{ $order->order_number }}</h2>
                <a href="{{ route('frontend.orders.index') }}" class="btn btn-outline-primary">← Kembali</a>
            </div>
            
            <!-- Status dan Info Pesanan -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Status Pesanan</h5>
                            <span class="badge badge-{{ $order->status_badge_class }} badge-lg">{{ ucfirst($order->status) }}</span>
                            <p class="mt-2 mb-0">
                                <small class="text-muted">Dibuat: {{ $order->created_at->format('d M Y H:i') }}</small>
                                @if($order->payment_date)
                                    <br><small class="text-muted">Dibayar: {{ $order->payment_date->format('d M Y H:i') }}</small>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <h5>Total Pembayaran</h5>
                            <h3 class="text-success">{{ $order->formatted_total_amount }}</h3>
                            <p class="mb-0">
                                <small class="text-muted">Metode: {{ strtoupper($order->payment_method) }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Detail Produk -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Produk yang Dipesan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $item->product->gambar_url }}" alt="{{ $item->product->nama }}" class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0">{{ $item->product->nama }}</h6>
                                                            <small class="text-muted">{{ $item->product->kategori->nama }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">{{ $item->formatted_price }}</td>
                                                <td class="align-middle">{{ $item->quantity }}</td>
                                                <td class="align-middle">{{ $item->formatted_subtotal }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total</th>
                                            <th>{{ $order->formatted_total_amount }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informasi Pengiriman -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Alamat Pengiriman:</strong>
                                    <p>{{ $order->shipping_address }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Nomor Telepon:</strong>
                                    <p>{{ $order->phone }}</p>
                                </div>
                            </div>
                            @if($order->notes)
                                <div class="row">
                                    <div class="col-12">
                                        <strong>Catatan:</strong>
                                        <p>{{ $order->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar Aksi -->
                <div class="col-md-4">
                    <!-- Status Timeline -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Status Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item {{ $order->status == 'pending' ? 'active' : ($order->status != 'cancelled' ? 'completed' : '') }}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6>Menunggu Pembayaran</h6>
                                        <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                                
                                @if($order->status != 'cancelled')
                                    <div class="timeline-item {{ in_array($order->status, ['paid', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <h6>Pembayaran Dikonfirmasi</h6>
                                            @if($order->payment_date)
                                                <small class="text-muted">{{ $order->payment_date->format('d M Y H:i') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <h6>Pesanan Diproses</h6>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '' }}">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <h6>Pesanan Dikirim</h6>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item {{ $order->status == 'delivered' ? 'completed' : '' }}">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <h6>Pesanan Selesai</h6>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-item cancelled">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <h6>Pesanan Dibatalkan</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bukti Pembayaran -->
                    @if($order->payment_proof)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Bukti Pembayaran</h5>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ $order->payment_proof_url }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 200px;">
                                <br>
                                <a href="{{ $order->payment_proof_url }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">Lihat Full Size</a>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Aksi -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Aksi</h5>
                        </div>
                        <div class="card-body">
                            @if($order->status == 'pending')
                                @if(!$order->payment_proof)
                                    <a href="{{ route('frontend.orders.payment', $order->id) }}" class="btn btn-warning btn-block mb-2">Upload Bukti Pembayaran</a>
                                @endif
                                <form action="{{ route('frontend.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-danger btn-block">Batalkan Pesanan</button>
                                </form>
                            @endif
                            
                            @if($order->status == 'shipped')
                                <form action="{{ route('frontend.orders.confirmDelivery', $order->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa pesanan sudah diterima?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-block mb-2">Terima Pesanan</button>
                                </form>
                            @endif
                            
                            @if(in_array($order->status, ['delivered', 'paid', 'processing', 'shipped']))
                                <a href="{{ route('frontend.orders.invoice', $order->id) }}" class="btn btn-outline-secondary btn-block" target="_blank">Download Invoice</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 20px;
    width: 2px;
    height: calc(100% + 10px);
    background-color: #dee2e6;
}

.timeline-marker {
    position: absolute;
    left: -27px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #dee2e6;
    border: 2px solid #fff;
}

.timeline-item.completed .timeline-marker {
    background-color: #28a745;
}

.timeline-item.active .timeline-marker {
    background-color: #007bff;
}

.timeline-item.cancelled .timeline-marker {
    background-color: #dc3545;
}

.timeline-item.completed::before {
    background-color: #28a745;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-size: 14px;
}
</style>
@endpush
@endsection