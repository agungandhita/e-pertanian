@extends('admin.layouts.main')

@section('title', 'Laporan Pendapatan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Pendapatan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exportModal">
                            <i class="fas fa-download"></i> Export Excel
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filter Periode -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('admin.admin.laporan.index') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="start_date" id="start_date" 
                                               value="{{ $startDate }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date" 
                                               value="{{ $endDate }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $totalPesanan }}</h4>
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
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                                            <p class="mb-0">Total Pendapatan</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-money-bill-wave fa-2x"></i>
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
                                            <h4>Rp {{ number_format($rataRataPendapatan, 0, ',', '.') }}</h4>
                                            <p class="mb-0">Rata-rata per Pesanan</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-chart-line fa-2x"></i>
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
                                            <h4>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</h4>
                                            <p class="mb-0">s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Pendapatan per Hari -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Pendapatan per Hari</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="dailyRevenueChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Top 5 Produk</h5>
                                </div>
                                <div class="card-body">
                                    @if($pendapatanPerProduk->count() > 0)
                                        @foreach($pendapatanPerProduk->sortByDesc('total')->take(5) as $produk => $data)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <strong>{{ $produk }}</strong><br>
                                                    <small class="text-muted">{{ $data['count'] }} terjual</small>
                                                </div>
                                                <div class="text-end">
                                                    <strong>Rp {{ number_format($data['total'], 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @else
                                        <p class="text-muted">Tidak ada data produk</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Detail Pesanan -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Detail Pesanan</h5>
                        </div>
                        <div class="card-body">
                            @if($orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Pelanggan</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $order->user->name ?? '-' }}</td>
                                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                                                           class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada data pesanan untuk periode ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Export -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.admin.laporan.export') }}" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="export_start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_date" id="export_start_date" 
                                   value="{{ $startDate }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="export_end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="end_date" id="export_end_date" 
                                   value="{{ $endDate }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-download"></i> Download Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Pendapatan per Hari
const ctx = document.getElementById('dailyRevenueChart').getContext('2d');
const dailyData = @json($pendapatanPerHari);

const labels = Object.keys(dailyData).map(date => {
    return new Date(date).toLocaleDateString('id-ID', {
        day: '2-digit',
        month: '2-digit'
    });
});

const data = Object.values(dailyData);

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: data,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endpush