@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.artikel.index') }}" class="text-decoration-none">Artikel</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($artikel->judul, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Article Content -->
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm">
                <!-- Article Header -->
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="mb-3">
                        <span class="badge bg-primary mb-2">
                            <i class="fas fa-newspaper me-1"></i>Artikel Edukasi
                        </span>
                    </div>
                    <h1 class="card-title h2 fw-bold text-dark mb-3">{{ $artikel->judul }}</h1>
                    
                    <!-- Article Meta -->
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>{{ $artikel->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $artikel->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <i class="fas fa-eye me-2"></i>
                            <span>Artikel Pertanian</span>
                        </div>
                    </div>
                </div>

                <!-- Article Image -->
                @if($artikel->gambar)
                <div class="px-4">
                    <div class="position-relative overflow-hidden rounded">
                        <img src="{{ $artikel->gambar_url }}" alt="{{ $artikel->judul }}" 
                             class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>
                @endif

                <!-- Article Body -->
                <div class="card-body px-4 pb-4">
                    <div class="article-content">
                        {!! nl2br(e($artikel->deskripsi)) !!}
                    </div>
                    
                    <!-- Article Footer -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Terakhir diperbarui: {{ $artikel->updated_at->format('d F Y, H:i') }} WIB
                            </small>
                        </div>
                        <div>
                            <!-- Social Share Buttons -->
                            <button class="btn btn-outline-primary btn-sm me-2" onclick="shareArticle()">
                                <i class="fas fa-share-alt me-1"></i>Bagikan
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Navigation Buttons -->
            <div class="mt-4">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Artikel
                    </a>
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak Artikel
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Artikel
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-muted mb-1">Dipublikasi</h6>
                                <p class="mb-0 fw-bold">{{ $artikel->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Kategori</h6>
                            <p class="mb-0 fw-bold">Edukasi Pertanian</p>
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
                        <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-play-circle me-2"></i>Multimedia Edukasi
                        </a>
                        <a href="{{ route('frontend.modul.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-book me-2"></i>Modul Pembelajaran
                        </a>
                        <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-newspaper me-2"></i>Berita Terbaru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2c3e50;
    text-align: justify;
}

.article-content p {
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
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $artikel->judul }}',
            text: '{{ Str::limit($artikel->deskripsi, 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link artikel telah disalin ke clipboard!');
        });
    }
}
</script>
@endsection