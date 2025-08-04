@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.berita.index') }}" class="text-decoration-none">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main News Content -->
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm">
                <!-- News Header -->
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="mb-3">
                        <span class="badge bg-info mb-2">
                            <i class="fas fa-bullhorn me-1"></i>Berita Terkini
                        </span>
                    </div>
                    <h1 class="card-title h2 fw-bold text-dark mb-3">{{ $berita->judul }}</h1>
                    
                    <!-- News Meta -->
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>{{ $berita->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $berita->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <i class="fas fa-eye me-2"></i>
                            <span>Berita Pertanian</span>
                        </div>
                    </div>
                </div>

                <!-- News Image -->
                @if($berita->gambar)
                <div class="px-4">
                    <div class="position-relative overflow-hidden rounded">
                        <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}" 
                             class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>
                @endif

                <!-- News Body -->
                <div class="card-body px-4 pb-4">
                    <div class="news-content">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>
                    
                    <!-- News Footer -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Berita untuk edukasi dan informasi pertanian
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <button onclick="shareNews()" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-share-alt me-1"></i>Bagikan
                            </button>
                            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-print me-1"></i>Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- News Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Berita
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-muted mb-1">Dipublikasi</h6>
                                <p class="mb-0 fw-bold">{{ $berita->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Kategori</h6>
                            <p class="mb-0 fw-bold">Berita Pertanian</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Links -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-link me-2"></i>Konten Terkait
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-newspaper me-2"></i>Artikel Edukasi
                        </a>
                        <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-play-circle me-2"></i>Multimedia Edukasi
                        </a>
                        <a href="{{ route('frontend.modul.index') }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-book me-2"></i>Modul Pembelajaran
                        </a>
                    </div>
                </div>
            </div>

            <!-- Latest News -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-newspaper me-2"></i>Berita Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <!-- Sample related news items -->
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-light rounded" style="width: 60px; height: 60px;">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-bullhorn text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="#" class="text-decoration-none text-dark hover-primary">
                                        Teknologi Pertanian Modern untuk Petani
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    2 hari yang lalu
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-light rounded" style="width: 60px; height: 60px;">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-bullhorn text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="#" class="text-decoration-none text-dark hover-primary">
                                        Program Bantuan Bibit untuk Petani Desa
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    5 hari yang lalu
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-light rounded" style="width: 60px; height: 60px;">
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-bullhorn text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="#" class="text-decoration-none text-dark hover-primary">
                                        Pelatihan Organik untuk Meningkatkan Hasil
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    1 minggu yang lalu
                                </small>
                            </div>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-primary btn-sm">
                                Lihat Semua Berita
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.news-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2c3e50;
    text-align: justify;
}

.news-content p {
    margin-bottom: 1.5rem;
}

.breadcrumb-item a {
    color: #007bff;
}

.breadcrumb-item.active {
    color: #6c757d;
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.hover-primary:hover {
    color: var(--bs-primary) !important;
}

.btn-info {
    background: linear-gradient(45deg, #17a2b8, #138496);
    border: none;
}

.btn-info:hover {
    background: linear-gradient(45deg, #138496, #117a8b);
}

@media print {
    .breadcrumb, .btn, .card-header, nav {
        display: none !important;
    }
    
    .container {
        max-width: 100% !important;
    }
    
    .col-lg-4 {
        display: none !important;
    }
    
    .col-lg-8 {
        width: 100% !important;
    }
}
</style>

<!-- JavaScript -->
<script>
function shareNews() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $berita->judul }}',
            text: '{{ Str::limit($berita->deskripsi, 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link berita telah disalin ke clipboard!');
        });
    }
}
</script>
@endsection