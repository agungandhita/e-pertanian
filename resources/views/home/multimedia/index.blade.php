@extends('home.layouts.main')

@section('container')
<div class="container-fluid px-4 py-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-section bg-gradient-primary text-white rounded-4 p-5 text-center position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                    <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse">
                                <circle cx="25" cy="25" r="2" fill="white" opacity="0.3"/>
                                <circle cx="75" cy="75" r="1.5" fill="white" opacity="0.2"/>
                                <circle cx="50" cy="10" r="1" fill="white" opacity="0.4"/>
                                <circle cx="10" cy="60" r="2.5" fill="white" opacity="0.1"/>
                                <circle cx="90" cy="30" r="1.8" fill="white" opacity="0.3"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grain)"/>
                    </svg>
                </div>
                <div class="position-relative z-index-1">
                    <div class="mb-4">
                        <i class="fas fa-photo-video fa-4x mb-3 text-warning"></i>
                    </div>
                    <h1 class="display-3 fw-bold mb-4">Multimedia Edukasi Pertanian</h1>
                    <p class="lead mb-4 fs-5">Jelajahi koleksi lengkap video, audio, dan gambar edukatif seputar dunia pertanian modern untuk meningkatkan pengetahuan dan keterampilan bertani Anda</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <span class="badge bg-light text-dark px-3 py-2 fs-6">
                            <i class="fas fa-play me-2"></i>Video Edukasi
                        </span>
                        <span class="badge bg-light text-dark px-3 py-2 fs-6">
                            <i class="fas fa-volume-up me-2"></i>Audio Learning
                        </span>
                        <span class="badge bg-light text-dark px-3 py-2 fs-6">
                            <i class="fas fa-image me-2"></i>Infografis
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="fas fa-filter me-2 text-primary"></i>Filter Konten:
                            </h5>
                            <small class="text-muted">Pilih jenis media yang ingin ditampilkan</small>
                        </div>
                        <div class="col-lg-9">
                            <div class="filter-buttons d-flex gap-2 flex-wrap justify-content-lg-end">
                                <input type="radio" class="btn-check" name="filter" id="semua" autocomplete="off" checked>
                                <label class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold" for="semua">
                                    <i class="fas fa-th-large me-2"></i>Semua Media
                                    <span class="badge bg-primary ms-2">{{ $multimedias->total() }}</span>
                                </label>
                                
                                <input type="radio" class="btn-check" name="filter" id="video" autocomplete="off">
                                <label class="btn btn-outline-danger rounded-pill px-4 py-2 fw-semibold" for="video">
                                    <i class="fas fa-play me-2"></i>Video
                                    <span class="badge bg-danger ms-2">{{ $multimedias->where('jenis_media', 'video')->count() }}</span>
                                </label>
                                
                                <input type="radio" class="btn-check" name="filter" id="audio" autocomplete="off">
                                <label class="btn btn-outline-info rounded-pill px-4 py-2 fw-semibold" for="audio">
                                    <i class="fas fa-volume-up me-2"></i>Audio
                                    <span class="badge bg-info ms-2">{{ $multimedias->where('jenis_media', 'audio')->count() }}</span>
                                </label>
                                
                                <input type="radio" class="btn-check" name="filter" id="gambar" autocomplete="off">
                                <label class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold" for="gambar">
                                    <i class="fas fa-image me-2"></i>Gambar
                                    <span class="badge bg-success ms-2">{{ $multimedias->where('jenis_media', 'gambar')->count() }}</span>
                                </label>
                                
                                <input type="radio" class="btn-check" name="filter" id="infografis" autocomplete="off">
                                <label class="btn btn-outline-warning rounded-pill px-4 py-2 fw-semibold" for="infografis">
                                    <i class="fas fa-chart-bar me-2"></i>Infografis
                                    <span class="badge bg-warning ms-2">{{ $multimedias->where('jenis_media', 'infografis')->count() }}</span>
                                </label>
                            </div>
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
            <div class="col-xl-4 col-lg-6 col-md-6 multimedia-item" data-type="{{ $multimedia->jenis_media }}">
                <div class="card h-100 border-0 shadow-lg multimedia-card rounded-4 overflow-hidden">
                    <!-- Media Preview -->
                    <div class="position-relative multimedia-preview">
                        @if($multimedia->jenis_media == 'video')
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
                                    <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="tooltip" title="Tonton di YouTube">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                            @elseif($multimedia->file_path)
                                <div class="ratio ratio-16x9">
                                    <video controls class="rounded-top" preload="metadata">
                                        <source src="{{ asset('storage/' . $multimedia->file_path) }}" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                </div>
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-primary bg-gradient px-3 py-2 rounded-pill shadow">
                                        <i class="fas fa-play me-2"></i>Video Lokal
                                    </span>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-gradient-secondary" style="height: 250px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    <div class="text-center text-white">
                                        <i class="fas fa-video fa-4x opacity-75 mb-3"></i>
                                        <p class="mb-0 fw-semibold">Video Media</p>
                                    </div>
                                </div>
                            @endif
                        @elseif($multimedia->jenis_media == 'audio')
                            <div class="audio-preview bg-gradient-info d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="text-center text-white">
                                    <div class="audio-icon-container mb-4">
                                        <i class="fas fa-music fa-4x opacity-75"></i>
                                        <div class="audio-waves mt-3">
                                            <span></span><span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                    @if($multimedia->file_path)
                                        <audio controls class="w-100 mt-3" style="max-width: 280px;">
                                            <source src="{{ asset('storage/' . $multimedia->file_path) }}" type="audio/mpeg">
                                            Browser Anda tidak mendukung tag audio.
                                        </audio>
                                    @endif
                                </div>
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-info bg-gradient px-3 py-2 rounded-pill shadow">
                                    <i class="fas fa-volume-up me-2"></i>Audio
                                </span>
                            </div>
                        @elseif($multimedia->jenis_media == 'gambar')
                            <div class="ratio ratio-16x9 image-container">
                                @if($multimedia->gambar)
                                    <img src="{{ $multimedia->gambar_url }}" 
                                         class="card-img-top object-fit-cover hover-zoom" 
                                         alt="{{ $multimedia->deskripsi }}"
                                         loading="lazy">
                                @elseif($multimedia->file_path)
                                    <img src="{{ asset('storage/' . $multimedia->file_path) }}" 
                                         class="card-img-top object-fit-cover hover-zoom" 
                                         alt="{{ $multimedia->deskripsi }}"
                                         loading="lazy">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-gradient-success" style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <div class="text-center text-white">
                                            <i class="fas fa-image fa-4x opacity-75 mb-3"></i>
                                            <p class="mb-0 fw-semibold">Gambar Media</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="image-overlay d-flex align-items-center justify-content-center">
                                    <button class="btn btn-light btn-lg rounded-circle" data-bs-toggle="modal" data-bs-target="#imageModal{{ $multimedia->id }}">
                                        <i class="fas fa-search-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-success bg-gradient px-3 py-2 rounded-pill shadow">
                                    <i class="fas fa-image me-2"></i>Gambar
                                </span>
                            </div>
                        @elseif($multimedia->jenis_media == 'infografis')
                            <div class="ratio ratio-16x9 infografis-container">
                                @if($multimedia->file_path)
                                    <img src="{{ asset('storage/' . $multimedia->file_path) }}" 
                                         class="card-img-top object-fit-cover" 
                                         alt="{{ $multimedia->deskripsi }}"
                                         loading="lazy">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-gradient-warning" style="height: 250px; background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                                        <div class="text-center text-dark">
                                            <i class="fas fa-chart-bar fa-4x opacity-75 mb-3"></i>
                                            <p class="mb-0 fw-semibold">Infografis Media</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="infografis-overlay d-flex align-items-center justify-content-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                        <p class="mb-0 fw-semibold">Lihat Infografis</p>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-warning bg-gradient px-3 py-2 rounded-pill shadow text-dark">
                                    <i class="fas fa-chart-bar me-2"></i>Infografis
                                </span>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-gradient-secondary" style="height: 250px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="text-center text-white">
                                    <i class="fas fa-file fa-4x opacity-75 mb-3"></i>
                                    <p class="mb-0 fw-semibold">File Media</p>
                                </div>
                            </div>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-secondary bg-gradient px-3 py-2 rounded-pill shadow">
                                    <i class="fas fa-file me-2"></i>File
                                </span>
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
                                    @if($multimedia->jenis_media == 'video' && $multimedia->youtube_url)
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
                    <p class="lead mb-4">Konten multimedia edukasi pertanian akan segera hadir untuk membantu meningkatkan pengetahuan bertani Anda. Silakan kembali lagi nanti atau jelajahi konten lainnya.</p>
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
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.card-title {
    color: #1a1a1a !important;
    line-height: 1.5;
    font-size: 1.2rem;
    font-weight: 600;
}

.card-body {
    padding: 1.5rem;
}

.text-muted {
    color: #495057 !important;
    font-size: 0.95rem;
}

.btn-success {
    background: #28a745;
    border: 2px solid #28a745;
    font-weight: 600;
    padding: 0.5rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background: #218838;
    border-color: #218838;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}

.display-4 {
    color: #1a1a1a !important;
    font-weight: 700;
}

.lead {
    color: #495057 !important;
    font-size: 1.1rem;
    line-height: 1.6;
}

.border-success {
    border-color: #28a745 !important;
}

.btn-outline-success {
    color: #28a745;
    border-color: #28a745;
    font-weight: 600;
    padding: 0.6rem 1.2rem;
}

.btn-outline-success:checked + label,
.btn-outline-success.active {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}

.btn-outline-success:hover {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.8rem;
    font-weight: 600;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .display-4 {
        font-size: 2.5rem;
    }
    
    .lead {
        font-size: 1rem;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
    
    .btn-group .btn {
        padding: 0.5rem 0.8rem;
        font-size: 0.9rem;
    }
}

/* Better contrast for older users */
.card {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

h6 {
    color: #1a1a1a !important;
    font-weight: 600;
    font-size: 1rem;
}

h5 {
    color: #1a1a1a !important;
    font-weight: 700;
}

h3 {
    color: #1a1a1a !important;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
    font-weight: 600;
}

.btn-outline-success.btn-lg {
    border-width: 2px;
}

.btn-outline-success.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

/* Improve filter button responsiveness */
@media (max-width: 576px) {
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        border-radius: 0.375rem !important;
        margin-bottom: 0.5rem;
    }
    
    .btn-group .btn:last-child {
        margin-bottom: 0;
    }
}

/* Better spacing for cards */
.multimedia-item {
    margin-bottom: 2rem;
}

/* Improve pagination styling */
.pagination {
    justify-content: center;
}

.pagination .page-link {
    color: #28a745;
    border-color: #28a745;
    padding: 0.75rem 1rem;
    font-weight: 600;
}

.pagination .page-link:hover {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #28a745;
    border-color: #28a745;
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