@extends('home.layouts.main')

@section('container')
<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden">
    <div class="hero-bg"></div>
    <div class="container-fluid px-0">
        <div class="row g-0 min-vh-100 align-items-center">
            <!-- Content -->
            <div class="col-lg-6 px-4 px-lg-5">
                <div class="hero-content text-white">
                    <span class="badge bg-light text-primary px-4 py-2 rounded-pill mb-4 fs-6">
                        <i class="fas fa-photo-video me-2"></i>Portal Multimedia agriedu
                    </span>

                    <h1 class="display-3 fw-bold mb-4 lh-sm">
                        Jelajahi Dunia
                        <span class="text-warning">Multimedia</span>
                        Pertanian
                    </h1>

                    <p class="fs-5 mb-5 opacity-90">
                        Temukan koleksi lengkap video, audio, dan gambar edukatif seputar dunia pertanian modern untuk meningkatkan pengetahuan dan keterampilan bertani Anda.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#multimedia-grid" class="btn btn-warning btn-lg px-4 py-3 rounded-pill">
                            <i class="fab fa-youtube me-2"></i>Lihat Semua Video
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="col-lg-6">
                <div class="stats-grid p-4 p-lg-5">
                    <div class="row g-4 justify-content-center">
                        <div class="col-8">
                            <div class="stat-card text-center">
                                <div class="stat-icon bg-danger">
                                    <i class="fab fa-youtube"></i>
                                </div>
                                <h3 class="stat-number">{{ $multimedias->total() }}</h3>
                                <p class="stat-label">Video YouTube</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="content-section py-5">
    <div class="container-fluid px-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-dark mb-3">Koleksi Multimedia</h2>
            <p class="lead text-muted">Jelajahi berbagai konten multimedia edukatif untuk pembelajaran pertanian</p>
        </div>

        <!-- Filter Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="content-card">
                    <div class="content-header bg-primary">
                        <h5 class="mb-0 text-white"><i class="fas fa-filter me-2"></i>Filter Konten</h5>
                    </div>
                    <div class="content-body">
                        <div class="filter-buttons d-flex gap-2 flex-wrap justify-content-center">
                            <div class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                                <i class="fab fa-youtube me-2"></i>Semua Video YouTube
                                <span class="badge bg-light text-primary ms-2">{{ $multimedias->total() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Multimedia Grid -->
    @if($multimedias->count() > 0)
        <div class="row g-4" id="multimedia-grid">
            @foreach($multimedias as $multimedia)
            <div class="col-xl-4 col-lg-6 col-md-6 multimedia-item">
                <div class="card h-100 border-0 shadow-lg multimedia-card rounded-4 overflow-hidden">
                    <!-- Media Preview -->
                    <div class="position-relative multimedia-preview">
                        @if($multimedia->youtube_url)
                            <div class="ratio ratio-16x9">
                                @php
                                    $youtube_id = '';
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $multimedia->youtube_url, $matches)) {
                                        $youtube_id = $matches[1];
                                    }
                                @endphp
                                <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}"
                                        title="{{ $multimedia->deskripsi }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        class="rounded-top">
                                </iframe>
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-danger bg-gradient px-3 py-2 rounded-pill shadow">
                                    <i class="fab fa-youtube me-2"></i>YouTube Video
                                </span>
                            </div>
                            <div class="position-absolute top-0 end-0 m-3">
                                <a href="{{ $multimedia->youtube_url }}" target="_blank" class="btn btn-light btn-sm rounded-circle" data-bs-toggle="tooltip" title="Tonton di YouTube">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-gradient-secondary" style="height: 250px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="text-center text-white">
                                    <i class="fab fa-youtube fa-4x opacity-75 mb-3"></i>
                                    <p class="mb-0 fw-semibold">Video YouTube</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Card Content -->
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title fw-bold mb-0 flex-grow-1 me-2">{{ Str::limit($multimedia->deskripsi, 45) }}</h5>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('frontend.multimedia.show', $multimedia) }}"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="shareContent('{{ $multimedia->deskripsi }}', '{{ route('frontend.multimedia.show', $multimedia) }}')"><i class="fas fa-share me-2"></i>Bagikan</a></li>
                                    @if($multimedia->youtube_url)
                                        <li><a class="dropdown-item" href="{{ $multimedia->youtube_url }}" target="_blank"><i class="fab fa-youtube me-2"></i>Buka di YouTube</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <p class="card-text text-muted mb-3" style="font-size: 0.9rem; line-height: 1.5;">{{ Str::limit($multimedia->deskripsi, 85) }}</p>

                        <div class="multimedia-meta mb-3">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                        <span>{{ $multimedia->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-clock me-2 text-success"></i>
                                        <span>{{ $multimedia->created_at->format('H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('frontend.multimedia.show', $multimedia) }}" class="btn btn-primary btn-sm flex-grow-1 rounded-pill fw-semibold">
                                <i class="fas fa-play me-2"></i>Lihat Konten
                            </a>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="toggleFavorite({{ $multimedia->id }})" data-bs-toggle="tooltip" title="Tambah ke Favorit">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($multimedias->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $multimedias->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-photo-video fa-5x text-success opacity-50"></i>
                    </div>
                    <h3 class="mb-3 fw-bold">Belum Ada Konten Multimedia</h3>
                    <p class="lead mb-4">Konten multimedia agriedu akan segera hadir untuk membantu meningkatkan pengetahuan bertani Anda. Silakan kembali lagi nanti atau jelajahi konten lainnya.</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ url('/') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda
                        </a>
                        <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-success btn-lg">
                            <i class="fas fa-newspaper me-2"></i>Baca Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
.hero-section {
    min-height: 100vh;
    position: relative;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 50%, #004085 100%);
    z-index: -1;
}

.hero-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="%23ffffff" opacity="0.1"/></svg>');
    background-size: 50px 50px;
}

.stats-grid {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    padding: 2rem 1rem;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 0;
    color: #333;
}

.stat-label {
    color: #666;
    margin: 0;
    font-weight: 500;
}

.content-section {
    background: #f8f9fa;
}

.content-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.content-card:hover {
    transform: translateY(-5px);
}

.content-header {
    padding: 1rem 1.5rem;
}

.content-body {
    padding: 1.5rem;
}

/* Enhanced multimedia card styling */
.multimedia-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0,0,0,0.05);
}

.multimedia-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

/* Media preview enhancements */
.multimedia-preview {
    position: relative;
    overflow: hidden;
}

.multimedia-preview::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
    transform: translateX(-100%);
    transition: transform 0.6s;
    z-index: 1;
}

.multimedia-card:hover .multimedia-preview::before {
    transform: translateX(100%);
}

/* Audio wave animation */
.audio-waves {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 3px;
}

.audio-waves span {
    width: 3px;
    height: 20px;
    background: rgba(255,255,255,0.7);
    border-radius: 2px;
    animation: audioWave 1.5s ease-in-out infinite;
}

.audio-waves span:nth-child(2) { animation-delay: 0.1s; }
.audio-waves span:nth-child(3) { animation-delay: 0.2s; }
.audio-waves span:nth-child(4) { animation-delay: 0.3s; }
.audio-waves span:nth-child(5) { animation-delay: 0.4s; }

@keyframes audioWave {
    0%, 100% { height: 20px; }
    50% { height: 35px; }
}

/* Image overlay effects */
.image-overlay, .infografis-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-container:hover .image-overlay,
.infografis-container:hover .infografis-overlay {
    opacity: 1;
}

.hover-zoom {
    transition: transform 0.3s ease;
}

.image-container:hover .hover-zoom {
    transform: scale(1.05);
}

/* Enhanced filter buttons */
.filter-buttons .btn {
    transition: all 0.3s ease;
    border-width: 2px;
    font-weight: 600;
}

.filter-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.filter-buttons .btn-check:checked + .btn {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .hero-section {
        min-height: auto;
        padding: 3rem 0;
    }

    .display-3 {
        font-size: 2.5rem;
    }

    .stats-grid {
        margin-top: 2rem;
    }

    .stat-card {
        padding: 1.5rem 1rem;
    }

    .stat-number {
        font-size: 2rem;
    }
}
</style>

<!-- JavaScript for filtering -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('input[name="filter"]');
    const multimediaItems = document.querySelectorAll('.multimedia-item');

    filterButtons.forEach(button => {
        button.addEventListener('change', function() {
            const filterValue = this.id;

            multimediaItems.forEach(item => {
                if (filterValue === 'semua' || item.dataset.type === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
