@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">Artikel agriedu</h1>
            <p class="lead text-muted">Temukan berbagai artikel edukatif seputar dunia pertanian dan teknologi terkini</p>
            <hr class="w-25 mx-auto border-primary border-3">
        </div>
    </div>

    <!-- Articles Grid -->
    @if($artikels->count() > 0)
        <div class="row g-4">
            @foreach($artikels as $artikel)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    <!-- Article Image -->
                    <div class="position-relative overflow-hidden">
                        @if($artikel->gambar)
                            <img src="{{ $artikel->gambar_url }}" class="card-img-top" alt="{{ $artikel->judul }}"
                                 style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-newspaper fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $artikel->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-3">{{ $artikel->judul }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($artikel->deskripsi, 120) }}
                        </p>

                        <!-- Article Meta -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $artikel->created_at->diffForHumans() }}
                            </small>
                            <a href="{{ route('frontend.artikel.show', $artikel) }}" class="btn btn-primary btn-sm">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($artikels->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $artikels->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-newspaper fa-5x text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">Belum Ada Artikel</h3>
                    <p class="text-muted mb-4">Artikel agriedu akan segera hadir. Silakan kembali lagi nanti.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">
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

.btn-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #004085);
    transform: translateY(-1px);
}

.display-4 {
    color: #2c3e50;
}

.border-primary {
    border-color: #007bff !important;
}
</style>
@endsection
