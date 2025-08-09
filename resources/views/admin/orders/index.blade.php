@extends('admin.layouts.main')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pesanan</h3>
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
                            <form method="GET" action="{{ route('admin.orders.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                           placeholder="Cari pesanan..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('admin.orders.index') }}">
                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Diterima</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.orders.report') }}" class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Laporan
                            </a>
                        </div>
                    </div>

                    <!-- Statistik Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['total_orders'] ?? 0 }}</h4>
                                            <p class="mb-0">Total Pesanan</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-shopping-cart fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['pending_orders'] ?? 0 }}</h4>
                                            <p class="mb-0">Pending</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['processing_orders'] ?? 0 }}</h4>
                                            <p class="mb-0">Diproses</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-cog fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['delivered_orders'] ?? 0 }}</h4>
                                            <p class="mb-0">Selesai</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>No. Pesanan</th>
                                    <th>Pembeli</th>
                                    <th>Produk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $index => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td>
                                        <strong>#{{ $order->order_number }}</strong>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $order->user->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @foreach($order->orderItems->take(2) as $item)
                                                <small>{{ $item->product->nama }} ({{ $item->quantity }}x)</small><br>
                                            @endforeach
                                            @if($order->orderItems->count() > 2)
                                                <small class="text-muted">+{{ $order->orderItems->count() - 2 }} lainnya</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{
                                            $order->status == 'pending' ? 'warning' :
                                            ($order->status == 'paid' ? 'info' :
                                            ($order->status == 'processing' ? 'primary' :
                                            ($order->status == 'shipped' ? 'secondary' :
                                            ($order->status == 'delivered' ? 'success' : 'danger'))))
                                        }}">
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
                                            @else
                                                Dibatalkan
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                        <br>
                                        <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                               class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($order->status == 'pending')
                                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="paid">
                                                    <button type="submit" class="btn btn-sm btn-success" title="Tandai Dibayar"
                                                            onclick="return confirm('Tandai pesanan sebagai dibayar?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($order->status == 'paid')
                                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="processing">
                                                    <button type="submit" class="btn btn-sm btn-primary" title="Proses"
                                                            onclick="return confirm('Mulai memproses pesanan?')">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($order->status == 'processing')
                                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="shipped">
                                                    <button type="submit" class="btn btn-sm btn-secondary" title="Kirim"
                                                            onclick="return confirm('Kirim pesanan?')">
                                                        <i class="fas fa-truck"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($order->status == 'shipped')
                                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="delivered">
                                                    <button type="submit" class="btn btn-sm btn-success" title="Tandai Diterima"
                                                            onclick="return confirm('Tandai pesanan sebagai diterima?')">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada pesanan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->appends(request()->query())->links() }}
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