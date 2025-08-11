@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="p-4">
    <!-- Header Dashboard -->
    <div class="mb-4">
        <h1 class="h2 fw-bold text-dark">Dashboard</h1>
        <p class="text-muted">Selamat datang di panel admin Website agriedu</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Users</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_users'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-primary">Siswa: {{ $stats['total_students'] ?? 0 }}</span>
                                <span class="badge bg-info">Admin: {{ $stats['total_admins'] ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="fas fa-users text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Artikel</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_artikels'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-success">Artikel Pertanian</span>
                            </div>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="fas fa-newspaper text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Berita</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_berita'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-info">Berita Terkini</span>
                            </div>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="fas fa-bullhorn text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Multimedia</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_multimedia'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-warning text-dark">Media</span>
                            </div>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="fas fa-photo-video text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Modul</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_moduls'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-purple text-black">Pembelajaran</span>
                            </div>
                        </div>
                        <div class="bg-purple bg-opacity-10 rounded p-3">
                            <i class="fas fa-book text-purple fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Kategori</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_kategoris'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-secondary">Klasifikasi</span>
                            </div>
                        </div>
                        <div class="bg-secondary bg-opacity-10 rounded p-3">
                            <i class="fas fa-tags text-secondary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Produk</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_products'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-success">Toko Online</span>
                            </div>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="fas fa-shopping-bag text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="small fw-medium text-muted mb-1">Total Pesanan</p>
                            <p class="h3 fw-bold mb-2">{{ $stats['total_orders'] ?? 0 }}</p>
                            <div class="d-flex gap-1">
                                <span class="badge bg-warning text-dark">Transaksi</span>
                            </div>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="fas fa-receipt text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->    
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                    <p class="text-muted small mb-0">Akses cepat ke fitur-fitur penting</p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.artikel.create') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-decoration-none">
                                <i class="fas fa-plus-circle fs-2 mb-2"></i>
                                <span class="fw-medium">Tambah Artikel</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.berita.create') }}" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-decoration-none">
                                <i class="fas fa-newspaper fs-2 mb-2"></i>
                                <span class="fw-medium">Tambah Berita</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.modul.create') }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-decoration-none">
                                <i class="fas fa-book fs-2 mb-2"></i>
                                <span class="fw-medium">Tambah Modul</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 text-decoration-none">
                                <i class="fas fa-shopping-bag fs-2 mb-2"></i>
                                <span class="fw-medium">Tambah Produk</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Artikel Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(isset($stats['recent_artikel']) && $stats['recent_artikel']->count() > 0)
                        @foreach($stats['recent_artikel'] as $artikel)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded mb-3">
                            <div class="d-flex align-items-center">
                                @if($artikel->gambar)
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="rounded me-3" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-newspaper text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="fw-medium mb-1">{{ $artikel->judul }}</p>
                                    <p class="small text-muted mb-0">{{ Str::limit($artikel->konten, 50) }}</p>
                                    <small class="text-primary">{{ $artikel->kategori->nama ?? 'Tanpa Kategori' }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success">Aktif</span>
                                <p class="small text-muted mt-1">{{ $artikel->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-newspaper text-muted fs-1 mb-3"></i>
                            <p class="text-muted">Belum ada artikel terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Statistik Konten</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="small text-muted">Total Berita</span>
                        <span class="fw-medium">{{ $stats['total_berita'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="small text-muted">Total Modul Pembelajaran</span>
                        <span class="fw-medium">{{ $stats['total_moduls'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="small text-muted">Total Media</span>
                        <span class="fw-medium">{{ $stats['total_multimedia'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="small text-muted">Total Produk</span>
                        <span class="fw-medium">{{ $stats['total_products'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="small text-muted">Total Pesanan</span>
                        <span class="fw-medium">{{ $stats['total_orders'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Content Section -->
    <div class="row g-3">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Berita Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(isset($stats['recent_berita']) && $stats['recent_berita']->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Konten</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats['recent_berita'] as $berita)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($berita->gambar)
                                                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="rounded me-2" width="32" height="32" style="object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                        <i class="fas fa-bullhorn text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium">{{ Str::limit($berita->judul, 30) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="small text-muted">{{ Str::limit(strip_tags($berita->konten), 50) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Aktif</span>
                                        </td>
                                        <td><small class="text-muted">{{ $berita->created_at->diffForHumans() }}</small></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-bullhorn text-muted fs-1 mb-3"></i>
                            <p class="text-muted">Belum ada berita yang tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Pengguna Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(isset($stats['recent_users']) && $stats['recent_users']->count() > 0)
                        @foreach($stats['recent_users'] as $user)
                        <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded mb-2">
                            <div class="d-flex align-items-center">
                                @if($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-medium">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-primary' }}">{{ ucfirst($user->role) }}</span>
                                <div><small class="text-muted">{{ $user->created_at->format('d M Y') }}</small></div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users text-muted fs-1 mb-3"></i>
                            <p class="text-muted">Belum ada pengguna baru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Dashboard Sections -->
    <div class="row g-3 mt-4">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(isset($stats['recent_orders']) && $stats['recent_orders']->count() > 0)
                        @foreach($stats['recent_orders'] as $order)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 rounded me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-receipt text-warning"></i>
                                </div>
                                <div>
                                    <p class="fw-medium mb-1">Order #{{ $order->id }}</p>
                                    <p class="small text-muted mb-0">{{ $order->user->name ?? 'Guest' }}</p>
                                    <small class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge 
                                    @if($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'completed') bg-success
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @else bg-info
                                    @endif
                                ">{{ ucfirst($order->status) }}</span>
                                <p class="small text-muted mt-1">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-receipt text-muted fs-1 mb-3"></i>
                            <p class="text-muted">Belum ada pesanan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Produk Terpopuler</h5>
                </div>
                <div class="card-body">
                    @if(isset($stats['popular_products']) && $stats['popular_products']->count() > 0)
                        @foreach($stats['popular_products'] as $product)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded mb-3">
                            <div class="d-flex align-items-center">
                                @if($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}" class="rounded me-3" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <div class="bg-success bg-opacity-10 rounded me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-shopping-bag text-success"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="fw-medium mb-1">{{ Str::limit($product->nama, 25) }}</p>
                                    <p class="small text-muted mb-0">{{ Str::limit($product->deskripsi, 40) }}</p>
                                    <small class="text-success">Rp {{ number_format($product->harga, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">{{ $product->orders_count ?? 0 }} Terjual</span>
                                <p class="small text-muted mt-1">Stok: {{ $product->stok }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-bag text-muted fs-1 mb-3"></i>
                            <p class="text-muted">Belum ada produk</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Chart Section -->
    <div class="row g-3 mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Aktivitas Website</h5>
                    <p class="text-muted small mb-0">Ringkasan aktivitas dalam 7 hari terakhir</p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
                                <i class="fas fa-eye text-primary fs-3 mb-2"></i>
                                <h4 class="fw-bold text-primary">{{ $stats['weekly_views'] ?? 0 }}</h4>
                                <p class="small text-muted mb-0">Total Views</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 bg-success bg-opacity-10 rounded">
                                <i class="fas fa-user-plus text-success fs-3 mb-2"></i>
                                <h4 class="fw-bold text-success">{{ $stats['weekly_registrations'] ?? 0 }}</h4>
                                <p class="small text-muted mb-0">Registrasi Baru</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 bg-warning bg-opacity-10 rounded">
                                <i class="fas fa-shopping-cart text-warning fs-3 mb-2"></i>
                                <h4 class="fw-bold text-warning">{{ $stats['weekly_orders'] ?? 0 }}</h4>
                                <p class="small text-muted mb-0">Pesanan Baru</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 bg-info bg-opacity-10 rounded">
                                <i class="fas fa-comments text-info fs-3 mb-2"></i>
                                <h4 class="fw-bold text-info">{{ $stats['weekly_comments'] ?? 0 }}</h4>
                                <p class="small text-muted mb-0">Komentar Baru</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
