@extends('home.layouts.main')

@section('title', 'Pesanan Saya')

@section('container')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Pesanan Saya</h2>
            
            <!-- Filter Status -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('frontend.orders.index') }}">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="status">Filter Status:</label>
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0">Order #{{ $order->order_number }}</h5>
                                    <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="badge badge-{{ $order->status_badge_class }} badge-lg">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6>Produk:</h6>
                                    @foreach($order->orderItems->take(3) as $item)
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ $item->product->gambar_url }}" alt="{{ $item->product->nama }}" class="img-thumbnail me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <small><strong>{{ $item->product->nama }}</strong></small>
                                                <br><small class="text-muted">{{ $item->quantity }} x {{ $item->formatted_price }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($order->orderItems->count() > 3)
                                        <small class="text-muted">dan {{ $order->orderItems->count() - 3 }} produk lainnya</small>
                                    @endif
                                </div>
                                <div class="col-md-4 text-right">
                                    <h5 class="text-success">{{ $order->formatted_total_amount }}</h5>
                                    <div class="btn-group-vertical" role="group">
                                        <a href="{{ route('frontend.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                                        
                                        @if($order->status == 'pending')
                                            <form action="{{ route('frontend.orders.cancel', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Batalkan</button>
                                            </form>
                                        @endif
                                        
                                        @if($order->status == 'shipped')
                                             <form action="{{ route('frontend.orders.confirmDelivery', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi bahwa pesanan sudah diterima?')">
                                                 @csrf
                                                 @method('PATCH')
                                                 <button type="submit" class="btn btn-outline-success btn-sm">Konfirmasi Terima</button>
                                             </form>
                                         @endif
                                        
                                        @if(in_array($order->status, ['delivered', 'paid', 'processing', 'shipped']))
                                            <a href="{{ route('frontend.orders.invoice', $order->id) }}" class="btn btn-outline-secondary btn-sm" target="_blank">Download Invoice</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            @if($order->status == 'pending' && !$order->payment_proof)
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle"></i> 
                                    Silakan upload bukti pembayaran untuk pesanan ini.
                                    <a href="{{ route('frontend.orders.payment', $order->id) }}" class="btn btn-warning btn-sm ml-2">Upload Bukti</a>
                                </div>
                            @elseif($order->status == 'pending' && $order->payment_proof)
                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-clock"></i> 
                                    Bukti pembayaran sudah diupload. Menunggu verifikasi admin.
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="text-center">
                    <div class="card">
                        <div class="card-body py-5">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h4>Belum Ada Pesanan</h4>
                            <p class="text-muted">Anda belum memiliki pesanan apapun.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection