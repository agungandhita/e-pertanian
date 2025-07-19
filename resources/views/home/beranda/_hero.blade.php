<!-- Hero Features Section -->
<div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-success mb-3">Koleksi Edukasi Pertanian</h2>
            <p class="lead text-muted">Akses ribuan materi pembelajaran pertanian berkualitas tinggi</p>
            <hr class="w-25 mx-auto" style="border: 2px solid #28a745; opacity: 1;">
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <!-- Total Artikel -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center hover-lift">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #28a745, #20c997);">
                                <i class="fas fa-newspaper fa-lg text-white"></i>
                            </div>
                        </div>
                        <h3 class="display-6 fw-bold mb-2 text-success">{{ $statistik['total_artikel'] ?? 0 }}</h3>
                        <h5 class="fw-semibold mb-1">Artikel Edukasi</h5>
                        <p class="text-muted mb-0 small">Panduan lengkap pertanian</p>
                    </div>
                </div>
            </div>

            <!-- Total Multimedia -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center hover-lift">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #007bff, #6610f2);">
                                <i class="fas fa-photo-video fa-lg text-white"></i>
                            </div>
                        </div>
                        <h3 class="display-6 fw-bold mb-2 text-primary">{{ $statistik['total_multimedia'] ?? 0 }}</h3>
                        <h5 class="fw-semibold mb-1">Video & Media</h5>
                        <p class="text-muted mb-0 small">Tutorial visual interaktif</p>
                    </div>
                </div>
            </div>

            <!-- Total Modul -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center hover-lift">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #ffc107, #fd7e14);">
                                <i class="fas fa-file-pdf fa-lg text-white"></i>
                            </div>
                        </div>
                        <h3 class="display-6 fw-bold mb-2 text-warning">{{ $statistik['total_modul'] ?? 0 }}</h3>
                        <h5 class="fw-semibold mb-1">Modul PDF</h5>
                        <p class="text-muted mb-0 small">Panduan praktis download</p>
                    </div>
                </div>
            </div>

            <!-- Total Berita -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center hover-lift">
                    <div class="card-body py-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 60px; height: 60px; background: linear-gradient(135deg, #17a2b8, #6f42c1);">
                                <i class="fas fa-bullhorn fa-lg text-white"></i>
                            </div>
                        </div>
                        <h3 class="display-6 fw-bold mb-2 text-info">{{ $statistik['total_berita'] ?? 0 }}</h3>
                        <h5 class="fw-semibold mb-1">Berita Terkini</h5>
                        <p class="text-muted mb-0 small">Update informasi pertanian</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="text-center mb-4">
            <h3 class="h4 fw-bold mb-2">Konten Terbaru</h3>
            <p class="text-muted">Jelajahi materi pembelajaran terkini dari berbagai kategori</p>
        </div>

        <div class="row g-4">
            <!-- Artikel Terbaru -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white border-0">
                        <h5 class="mb-0"><i class="fas fa-newspaper me-2"></i>Artikel Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($artikelTerbaru) && $artikelTerbaru->count() > 0)
                            @foreach($artikelTerbaru as $artikel)
                                <div class="d-flex align-items-start mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                    <div class="flex-shrink-0 me-3">
                                        @if($artikel->gambar)
                                            <img src="{{ $artikel->gambar_url }}" alt="{{ $artikel->judul }}"
                                                 class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <a href="{{ route('frontend.artikel.show', $artikel->id) }}"
                                               class="text-decoration-none text-dark hover-primary">
                                                {{ Str::limit($artikel->judul, 50) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $artikel->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-success btn-sm">
                                    Lihat Semua Artikel <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada artikel tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Multimedia Terbaru -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white border-0">
                        <h5 class="mb-0"><i class="fas fa-photo-video me-2"></i>Multimedia Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($multimediaTerbaru) && $multimediaTerbaru->count() > 0)
                            @foreach($multimediaTerbaru->take(3) as $multimedia)
                                <div class="d-flex align-items-start mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
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
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <a href="{{ route('frontend.multimedia.show', $multimedia->id) }}"
                                               class="text-decoration-none text-dark hover-primary">
                                                {{ Str::limit($multimedia->deskripsi, 50) }}
                                            </a>
                                        </h6>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="badge bg-light text-dark">{{ ucfirst($multimedia->jenis_media) }}</span>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $multimedia->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-primary btn-sm">
                                    Lihat Semua Multimedia <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-photo-video fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada multimedia tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Berita Terbaru -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-info text-white border-0">
                        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Berita Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($beritaTerbaru) && $beritaTerbaru->count() > 0)
                            @foreach($beritaTerbaru as $berita)
                                <div class="d-flex align-items-start mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                    <div class="flex-shrink-0 me-3">
                                        @if($berita->gambar)
                                            <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}"
                                                 class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-newspaper text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <a href="{{ route('frontend.berita.show', $berita->id) }}"
                                               class="text-decoration-none text-dark hover-primary">
                                                {{ Str::limit($berita->judul, 50) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $berita->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-info btn-sm">
                                    Lihat Semua Berita <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada berita tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.hover-primary:hover {
    color: var(--bs-primary) !important;
}

@media (max-width: 768px) {
    .card {
        margin-bottom: 1rem;
    }
    
    .display-6 {
        font-size: 2rem;
    }
}
</style>
