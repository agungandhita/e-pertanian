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
                    <span class="badge bg-light text-success px-4 py-2 rounded-pill mb-4 fs-6">
                        <i class="fas fa-leaf me-2"></i>Portal agriedu Desa Sambangan
                    </span>
                    
                    <h1 class="display-3 fw-bold mb-4 lh-sm">
                        Membangun Masa Depan
                        <span class="text-warning">Pertanian</span>
                        yang Berkelanjutan
                    </h1>
                    
                    <p class="fs-5 mb-5 opacity-90">
                        Bergabunglah dengan komunitas petani modern Desa Sambangan. 
                        Dapatkan akses ke pengetahuan, teknologi, dan inovasi pertanian terkini.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('frontend.artikel.index') }}" class="btn btn-warning btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-newspaper me-2"></i>Artikel
                        </a>
                        <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-play-circle me-2"></i>Video
                        </a>
                        <a href="{{ route('frontend.modul.index') }}" class="btn btn-light btn-lg px-4 py-3 rounded-pill text-success">
                            <i class="fas fa-book me-2"></i>Modul
                        </a>
                        <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-bullhorn me-2"></i>Berita
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="col-lg-6">
                <div class="stats-grid p-4 p-lg-5">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="stat-card text-center">
                                <div class="stat-icon bg-success">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <h3 class="stat-number">{{ $statistik['total_artikel'] ?? 0 }}</h3>
                                <p class="stat-label">Artikel</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card text-center">
                                <div class="stat-icon bg-primary">
                                    <i class="fas fa-photo-video"></i>
                                </div>
                                <h3 class="stat-number">{{ $statistik['total_multimedia'] ?? 0 }}</h3>
                                <p class="stat-label">Multimedia</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card text-center">
                                <div class="stat-icon bg-warning">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <h3 class="stat-number">{{ $statistik['total_modul'] ?? 0 }}</h3>
                                <p class="stat-label">Modul</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card text-center">
                                <div class="stat-icon bg-info">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <h3 class="stat-number">{{ $statistik['total_berita'] ?? 0 }}</h3>
                                <p class="stat-label">Berita</p>
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
            <h2 class="display-5 fw-bold text-dark mb-3">Konten Terbaru</h2>
            <p class="lead text-muted">Jelajahi materi pembelajaran terkini dari berbagai kategori</p>
        </div>
        
        <div class="row g-4">
            <!-- Artikel Terbaru -->
            <div class="col-lg-4">
                <div class="content-card h-100">
                    <div class="content-header bg-success">
                        <h5 class="mb-0 text-white"><i class="fas fa-newspaper me-2"></i>Artikel Terbaru</h5>
                    </div>
                    <div class="content-body">
                        @if(isset($artikelTerbaru) && $artikelTerbaru->count() > 0)
                            @foreach($artikelTerbaru as $artikel)
                                <div class="content-item">
                                    <div class="content-thumb">
                                        @if($artikel->gambar)
                                            <img src="{{ $artikel->gambar_url }}" alt="{{ $artikel->judul }}">
                                        @else
                                            <div class="content-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="content-info">
                                        <h6><a href="{{ route('frontend.artikel.show', $artikel->id) }}">{{ Str::limit($artikel->judul, 50) }}</a></h6>
                                        <small class="text-muted">{{ $artikel->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-success">Lihat Semua</a>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-newspaper"></i>
                                <p>Belum ada artikel tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Multimedia Terbaru -->
            <div class="col-lg-4">
                <div class="content-card h-100">
                    <div class="content-header bg-primary">
                        <h5 class="mb-0 text-white"><i class="fas fa-photo-video me-2"></i>Multimedia Terbaru</h5>
                    </div>
                    <div class="content-body">
                        @if(isset($multimediaTerbaru) && $multimediaTerbaru->count() > 0)
                            @foreach($multimediaTerbaru->take(3) as $multimedia)
                                <div class="content-item">
                                    <div class="content-thumb">
                                        <div class="content-placeholder">
                                            @if($multimedia->jenis_media == 'video')
                                                <i class="fas fa-play-circle text-danger"></i>
                                            @elseif($multimedia->jenis_media == 'audio')
                                                <i class="fas fa-volume-up text-warning"></i>
                                            @elseif($multimedia->jenis_media == 'gambar')
                                                <i class="fas fa-image text-info"></i>
                                            @else
                                                <i class="fas fa-chart-bar text-success"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="content-info">
                                        <h6><a href="{{ route('frontend.multimedia.show', $multimedia->id) }}">{{ Str::limit($multimedia->deskripsi, 50) }}</a></h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-light text-dark">{{ ucfirst($multimedia->jenis_media) }}</span>
                                            <small class="text-muted">{{ $multimedia->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-primary">Lihat Semua</a>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-photo-video"></i>
                                <p>Belum ada multimedia tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Berita Terbaru -->
            <div class="col-lg-4">
                <div class="content-card h-100">
                    <div class="content-header bg-info">
                        <h5 class="mb-0 text-white"><i class="fas fa-bullhorn me-2"></i>Berita Terbaru</h5>
                    </div>
                    <div class="content-body">
                        @if(isset($beritaTerbaru) && $beritaTerbaru->count() > 0)
                            @foreach($beritaTerbaru as $berita)
                                <div class="content-item">
                                    <div class="content-thumb">
                                        @if($berita->gambar)
                                            <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                                        @else
                                            <div class="content-placeholder">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="content-info">
                                        <h6><a href="{{ route('frontend.berita.show', $berita->id) }}">{{ Str::limit($berita->judul, 50) }}</a></h6>
                                        <small class="text-muted">{{ $berita->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-info">Lihat Semua</a>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-bullhorn"></i>
                                <p>Belum ada berita tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    background: linear-gradient(135deg, #28a745 0%, #20c997 50%, #17a2b8 100%);
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

.content-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #eee;
}

.content-item:last-child {
    border-bottom: none;
}

.content-thumb {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 1rem;
    flex-shrink: 0;
}

.content-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.content-placeholder {
    width: 100%;
    height: 100%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.2rem;
}

.content-info h6 {
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
}

.content-info a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.content-info a:hover {
    color: #007bff;
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: #6c757d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
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
@endsection
