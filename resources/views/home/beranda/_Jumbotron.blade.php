<!-- Jumbotron Section -->
<div class="position-relative overflow-hidden bg-gradient-primary text-white py-5">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
        <div class="d-flex flex-wrap">
            @for($i = 0; $i < 15; $i++)
                <i class="fas fa-seedling m-4 text-white"></i>
            @endfor
        </div>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center min-vh-60 py-5">
            <!-- Content -->
            <div class="col-lg-7">
                <div class="mb-4">
                    <span class="badge bg-light text-success px-4 py-3 rounded-pill mb-4 fs-6">
                        <i class="fas fa-leaf me-2"></i>Portal Edukasi Pertanian Desa Sambangan
                    </span>
                </div>

                <h1 class="display-3 fw-bold mb-4 lh-sm">
                    Membangun Masa Depan
                    <span class="text-warning">Pertanian</span>
                    yang Berkelanjutan
                </h1>

                <p class="fs-4 mb-5 opacity-90 lh-lg">
                    Bergabunglah dengan komunitas petani modern Desa Sambangan.
                    Dapatkan akses ke pengetahuan, teknologi, dan inovasi pertanian terkini
                    untuk meningkatkan produktivitas dan kesejahteraan.
                </p>

                <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                    <a href="{{ route('frontend.artikel.index') }}" class="btn btn-warning btn-lg px-5 py-3 rounded-pill fs-5 fw-semibold">
                        <i class="fas fa-newspaper me-3"></i>
                        Baca Artikel Pertanian
                    </a>
                    <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fs-5 fw-semibold">
                        <i class="fas fa-play-circle me-3"></i>
                        Tonton Video Edukasi
                    </a>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3">
                    <a href="{{ route('frontend.modul.index') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill fs-5 fw-semibold text-success">
                        <i class="fas fa-book me-3"></i>
                        Download Modul PDF
                    </a>
                    <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fs-5 fw-semibold">
                        <i class="fas fa-bullhorn me-3"></i>
                        Berita Terkini
                    </a>
                </div>
            </div>

            <!-- Image/Illustration -->
            <div class="col-lg-5">
                <div class="text-center">
                    <div class="position-relative d-inline-block">
                        <!-- Main Image -->
                        <div class="bg-white bg-opacity-15 rounded-circle p-5 shadow-lg mb-4" style="width: 200px; height: 200px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-tractor text-warning" style="font-size: 5rem;"></i>
                        </div>

                        <!-- Floating Elements -->
                        <div class="position-absolute top-0 start-0 translate-middle">
                            <div class="bg-warning rounded-circle p-3 shadow animate-pulse">
                                <i class="fas fa-seedling text-success fs-4"></i>
                            </div>
                        </div>

                        <div class="position-absolute top-0 end-0 translate-middle">
                            <div class="bg-success rounded-circle p-3 shadow animate-pulse" style="animation-delay: 1s;">
                                <i class="fas fa-leaf text-white fs-4"></i>
                            </div>
                        </div>

                        <div class="position-absolute bottom-0 start-50 translate-middle">
                            <div class="bg-info rounded-circle p-3 shadow animate-pulse" style="animation-delay: 2s;">
                                <i class="fas fa-water text-white fs-4"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="row g-2 mt-4">
                        <div class="col-6">
                            <div class="bg-white bg-opacity-20 rounded-3 p-3 text-center">
                                <i class="fas fa-users text-warning fs-3 mb-2"></i>
                                <h5 class="mb-0 fw-bold text-black">500+</h5>
                                <small class="opacity-90 text-black">Petani Aktif</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-20 rounded-3 p-3 text-center">
                                <i class="fas fa-chart-line text-warning fs-3 mb-2"></i>
                                <h5 class="mb-0 fw-bold text-black">95%</h5>
                                <small class="opacity-90 text-black">Kepuasan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-100" style="height: 60px;">
            <path d="M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z" fill="#f8f9fa"></path>
        </svg>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #28a745 0%, #20c997 50%, #17a2b8 100%);
}

.min-vh-60 {
    min-height: 60vh;
}

.animate-pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Better readability for 30-40+ age group */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Larger touch targets for mobile */
@media (max-width: 768px) {
    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }

    .display-3 {
        font-size: 2.5rem;
    }

    .fs-4 {
        font-size: 1.1rem !important;
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}
</style>
