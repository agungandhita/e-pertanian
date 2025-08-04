@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-warning mb-3">Modul Pembelajaran</h1>
            <p class="lead text-muted">Koleksi modul PDF untuk pembelajaran pertanian yang dapat diunduh</p>
            <hr class="w-25 mx-auto border-warning border-3">
        </div>
    </div>

    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-warning text-white border-warning">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control border-warning" id="searchModul" 
                                       placeholder="Cari modul pembelajaran...">
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <select class="form-select border-warning" id="sortModul">
                                <option value="terbaru">Terbaru</option>
                                <option value="terlama">Terlama</option>
                                <option value="nama">Nama A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul Grid -->
    @if($moduls->count() > 0)
        <div class="row g-4" id="modul-grid">
            @foreach($moduls as $modul)
            <div class="col-lg-4 col-md-6 modul-item" data-name="{{ strtolower($modul->judul) }}" data-date="{{ $modul->created_at->timestamp }}">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    <!-- PDF Preview -->
                    <div class="position-relative overflow-hidden bg-warning bg-opacity-10" style="height: 200px;">
                        @if($modul->cover)
                            <img src="{{ $modul->cover_url }}" alt="{{ $modul->judul }}" 
                                 class="img-fluid w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center">
                                    <i class="fas fa-file-pdf fa-4x text-warning mb-3"></i>
                                    <h6 class="text-warning fw-bold">Modul PDF</h6>
                                </div>
                            </div>
                        @endif
                        
                        <!-- File Size Badge -->
                        @if($modul->file_path)
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-download me-1"></i>PDF
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Card Content -->
                    <div class="card-body d-flex flex-column">
                        @if($modul->kategori)
                            <div class="mb-2">
                                <span class="badge bg-secondary">
                                    <i class="fas fa-tag me-1"></i>{{ $modul->kategori->nama }}
                                </span>
                            </div>
                        @endif
                        <h5 class="card-title fw-bold mb-3">{{ $modul->judul }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($modul->deskripsi, 100) }}
                        </p>
                        
                        <!-- Modul Meta -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $modul->created_at->format('d M Y') }}
                            </small>
                            <div class="btn-group" role="group">
                                <a href="{{ route('frontend.modul.show', $modul) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                                @if($modul->file_path)
                                    <a href="{{ route('frontend.modul.download', $modul) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-download me-1"></i>Unduh
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($moduls->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $moduls->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-file-pdf fa-5x text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">Belum Ada Modul</h3>
                    <p class="text-muted mb-4">Modul pembelajaran pertanian akan segera hadir. Silakan kembali lagi nanti.</p>
                    <a href="{{ url('/') }}" class="btn btn-warning">
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

.card-title {
    color: #2c3e50;
    line-height: 1.4;
}

.btn-warning {
    background: linear-gradient(45deg, #ffc107, #ffb300);
    border: none;
    transition: all 0.3s ease;
    color: #212529;
}

.btn-warning:hover {
    background: linear-gradient(45deg, #e0a800, #ff8f00);
    transform: translateY(-1px);
    color: #212529;
}

.btn-outline-warning {
    border-color: #ffc107;
    color: #ffc107;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.display-4 {
    color: #2c3e50;
}

.border-warning {
    border-color: #ffc107 !important;
}

.form-control:focus,
.form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.input-group-text.bg-warning {
    background-color: #ffc107 !important;
    border-color: #ffc107;
}

.text-warning {
    color: #ffc107 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}
</style>

<!-- JavaScript for search and sort -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchModul');
    const sortSelect = document.getElementById('sortModul');
    const modulItems = document.querySelectorAll('.modul-item');
    const modulGrid = document.getElementById('modul-grid');
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        modulItems.forEach(item => {
            const modulName = item.dataset.name;
            if (modulName.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Sort functionality
    sortSelect.addEventListener('change', function() {
        const sortValue = this.value;
        const itemsArray = Array.from(modulItems);
        
        itemsArray.sort((a, b) => {
            if (sortValue === 'nama') {
                return a.dataset.name.localeCompare(b.dataset.name);
            } else if (sortValue === 'terbaru') {
                return parseInt(b.dataset.date) - parseInt(a.dataset.date);
            } else if (sortValue === 'terlama') {
                return parseInt(a.dataset.date) - parseInt(b.dataset.date);
            }
        });
        
        // Re-append sorted items
        itemsArray.forEach(item => {
            modulGrid.appendChild(item);
        });
    });
});
</script>
@endsection