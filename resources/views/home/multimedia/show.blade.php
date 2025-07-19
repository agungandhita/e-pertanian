@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.multimedia.index') }}" class="text-decoration-none">Multimedia</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($multimedia->deskripsi, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Multimedia Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <!-- Multimedia Header -->
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="mb-3">
                        <span class="badge 
                            @if($multimedia->jenis_media == 'video') bg-dark
                            @elseif($multimedia->jenis_media == 'audio') bg-primary
                            @else bg-info
                            @endif mb-2">
                            @if($multimedia->jenis_media == 'video')
                                @if($multimedia->youtube_url)
                                    <i class="fab fa-youtube me-1"></i>Video YouTube
                                @else
                                    <i class="fas fa-play me-1"></i>Video Edukasi
                                @endif
                            @elseif($multimedia->jenis_media == 'audio')
                                <i class="fas fa-volume-up me-1"></i>Audio Edukasi
                            @else
                                <i class="fas fa-image me-1"></i>Gambar Edukasi
                            @endif
                        </span>
                    </div>
                    <h1 class="card-title h2 fw-bold text-dark mb-3">{{ $multimedia->deskripsi }}</h1>
                    
                    <!-- Multimedia Meta -->
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>{{ $multimedia->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $multimedia->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <i class="fas fa-tag me-2"></i>
                            <span>{{ ucfirst($multimedia->jenis_media) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Multimedia Content -->
                <div class="px-4">
                    <div class="position-relative overflow-hidden rounded">
                        @if($multimedia->jenis_media == 'video')
                            @if($multimedia->youtube_url)
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ str_replace('watch?v=', 'embed/', $multimedia->youtube_url) }}" 
                                            title="YouTube video" 
                                            allowfullscreen 
                                            class="rounded">
                                    </iframe>
                                </div>
                            @elseif($multimedia->file_path)
                                <video class="w-100" controls style="max-height: 500px;">
                                    <source src="{{ asset('storage/multimedia/files/' . $multimedia->file_path) }}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            @else
                                <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 400px;">
                                    <div class="text-center text-white">
                                        <i class="fas fa-video fa-4x mb-3"></i>
                                        <p>Video tidak tersedia</p>
                                    </div>
                                </div>
                            @endif
                        @elseif($multimedia->jenis_media == 'audio')
                            <div class="bg-primary text-white p-5 rounded text-center">
                                <i class="fas fa-volume-up fa-4x mb-4"></i>
                                <h4 class="mb-4">Audio Edukasi Pertanian</h4>
                                @if($multimedia->file_path)
                                    <audio controls class="w-100">
                                        <source src="{{ asset('storage/multimedia/files/' . $multimedia->file_path) }}" type="audio/mpeg">
                                        Browser Anda tidak mendukung audio.
                                    </audio>
                                @else
                                    <p>Audio tidak tersedia</p>
                                @endif
                            </div>
                        @else
                            @if($multimedia->gambar)
                                <img src="{{ $multimedia->gambar_url }}" alt="{{ $multimedia->deskripsi }}" 
                                     class="img-fluid w-100 rounded" style="max-height: 500px; object-fit: cover;">
                            @else
                                <div class="bg-info d-flex align-items-center justify-content-center" style="height: 400px;">
                                    <div class="text-center text-white">
                                        <i class="fas fa-image fa-4x mb-3"></i>
                                        <p>Gambar tidak tersedia</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Multimedia Description -->
                @if($multimedia->keterangan)
                <div class="card-body px-4 pb-4">
                    <div class="multimedia-content">
                        <h5 class="fw-bold mb-3">Deskripsi</h5>
                        <div class="text-muted">
                            {!! nl2br(e($multimedia->keterangan)) !!}
                        </div>
                    </div>
                    
                    <!-- Multimedia Footer -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Konten edukasi pertanian untuk pembelajaran
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <button onclick="shareMultimedia()" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-share-alt me-1"></i>Bagikan
                            </button>
                            @if($multimedia->file_path && in_array($multimedia->jenis_media, ['video', 'audio']))
                                <a href="{{ asset('storage/multimedia/files/' . $multimedia->file_path) }}" 
                                   download class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-download me-1"></i>Unduh
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Multimedia Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Media
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-muted mb-1">Dipublikasi</h6>
                                <p class="mb-0 fw-bold">{{ $multimedia->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Jenis Media</h6>
                            <p class="mb-0 fw-bold">{{ ucfirst($multimedia->jenis_media) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Links -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-link me-2"></i>Konten Terkait
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-newspaper me-2"></i>Artikel Edukasi
                        </a>
                        <a href="{{ route('frontend.modul.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-book me-2"></i>Modul Pembelajaran
                        </a>
                        <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-bullhorn me-2"></i>Berita Terbaru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.multimedia-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2c3e50;
    text-align: justify;
}

.multimedia-content p {
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

audio, video {
    outline: none;
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
function shareMultimedia() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $multimedia->deskripsi }}',
            text: 'Lihat konten multimedia edukasi pertanian ini',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link multimedia telah disalin ke clipboard!');
        });
    }
}
</script>
@endsection