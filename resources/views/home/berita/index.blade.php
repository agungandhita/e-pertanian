@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-info mb-3">Berita Pertanian</h1>
            <p class="lead text-muted">Informasi terkini seputar dunia pertanian dan perkembangan desa</p>
            <hr class="w-25 mx-auto border-info border-3">
        </div>
    </div>

    <!-- Featured News -->
    @if($berita->count() > 0)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            @if($berita->first()->gambar)
                                <img src="{{ $berita->first()->gambar_url }}" class="img-fluid w-100 h-100" 
                                     style="object-fit: cover; min-height: 300px;" alt="{{ $berita->first()->judul }}">
                            @else
                                <div class="bg-info d-flex align-items-center justify-content-center" style="min-height: 300px;">
                                    <i class="fas fa-bullhorn fa-4x text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="card-body h-100 d-flex flex-column justify-content-center p-5">
                                <div class="mb-3">
                                    <span class="badge bg-info fs-6 px-3 py-2">
                                        <i class="fas fa-star me-2"></i>Berita Utama
                                    </span>
                                </div>
                                <h2 class="card-title fw-bold mb-3">{{ $berita->first()->judul }}</h2>
                                <p class="card-text text-muted mb-4">
                                    {{ Str::limit($berita->first()->deskripsi, 150) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $berita->first()->created_at->format('d F Y') }}
                                    </small>
                                    <a href="{{ route('frontend.berita.show', $berita->first()) }}" class="btn btn-info">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-info text-white border-info">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control border-info" id="searchBerita" 
                                       placeholder="Cari berita...">
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <select class="form-select border-info" id="sortBerita">
                                <option value="terbaru">Terbaru</option>
                                <option value="terlama">Terlama</option>
                                <option value="judul">Judul A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    @if($berita->count() > 1)
        <div class="row g-4" id="berita-grid">
            @foreach($berita->skip(1) as $item)
            <div class="col-lg-4 col-md-6 berita-item" data-title="{{ strtolower($item->judul) }}" data-date="{{ $item->created_at->timestamp }}">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    <!-- News Image -->
                    <div class="position-relative overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ $item->gambar_url }}" class="card-img-top" alt="{{ $item->judul }}" 
                                 style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-bullhorn fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-info">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-3">{{ $item->judul }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($item->deskripsi, 120) }}
                        </p>
                        
                        <!-- News Meta -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $item->created_at->diffForHumans() }}
                            </small>
                            <a href="{{ route('frontend.berita.show', $item) }}" class="btn btn-info btn-sm">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($berita->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $berita->links() }}
                </div>
            </div>
        @endif
    @elseif($berita->count() == 0)
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-bullhorn fa-5x text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">Belum Ada Berita</h3>
                    <p class="text-muted mb-4">Berita pertanian terkini akan segera hadir. Silakan kembali lagi nanti.</p>
                    <a href="{{ url('/') }}" class="btn btn-info">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.hover-card:hover .card-img-top {
    transform: scale(1.05);
}

.card-title {
    color: #2c3e50;
    line-height: 1.4;
}

.btn-info {
    background: linear-gradient(45deg, #17a2b8, #138496);
    border: none;
    transition: all 0.3s ease;
}

.btn-info:hover {
    background: linear-gradient(45deg, #138496, #117a8b);
    transform: translateY(-1px);
}

.display-4 {
    color: #2c3e50;
}

.border-info {
    border-color: #17a2b8 !important;
}

.form-control:focus,
.form-select:focus {
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
}

.input-group-text.bg-info {
    background-color: #17a2b8 !important;
    border-color: #17a2b8;
}

.text-info {
    color: #17a2b8 !important;
}

.bg-info {
    background-color: #17a2b8 !important;
}

.badge.bg-info {
    background-color: #17a2b8 !important;
}

/* Featured news card animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<!-- JavaScript for search and sort -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchBerita');
    const sortSelect = document.getElementById('sortBerita');
    const beritaItems = document.querySelectorAll('.berita-item');
    const beritaGrid = document.getElementById('berita-grid');
    
    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            beritaItems.forEach(item => {
                const beritaTitle = item.dataset.title;
                if (beritaTitle.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Sort functionality
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            const itemsArray = Array.from(beritaItems);
            
            itemsArray.sort((a, b) => {
                if (sortValue === 'judul') {
                    return a.dataset.title.localeCompare(b.dataset.title);
                } else if (sortValue === 'terbaru') {
                    return parseInt(b.dataset.date) - parseInt(a.dataset.date);
                } else if (sortValue === 'terlama') {
                    return parseInt(a.dataset.date) - parseInt(b.dataset.date);
                }
            });
            
            // Re-append sorted items
            if (beritaGrid) {
                itemsArray.forEach(item => {
                    beritaGrid.appendChild(item);
                });
            }
        });
    }
});
</script>
@endsection