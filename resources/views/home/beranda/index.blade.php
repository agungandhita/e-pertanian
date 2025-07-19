@extends('home.layouts.main')

@section('container')
<div class="bg-white text-dark">
    <div class="container mt-2">
        @include('home.beranda._Jumbotron')
        
        <!-- Bagian Selamat Datang -->
        <div class="mt-5 bg-light px-4 px-md-5 py-5 rounded-3 shadow-sm">
            <div class="container">
                <div class="text-center mx-auto" style="max-width: 900px;">
                    <h2 class="display-4 fw-bold mb-4 text-dark">Selamat Datang di <span class="text-success position-relative">
                        EDUKASI PERTANIAN
                        <span class="position-absolute bottom-0 start-0 w-100 bg-success opacity-25 rounded" style="height: 8px;"></span>
                    </span></h2>
                    <p class="fs-5 text-muted lh-lg">Portal edukasi pertanian hadir sebagai solusi terdepan dalam memberikan informasi dan pengetahuan pertanian untuk masyarakat Desa Sambangan. Kami berkomitmen untuk memberikan edukasi yang berkualitas, mudah dipahami, dan bermanfaat bagi seluruh petani dan masyarakat.</p>
                </div>
                
                <!-- Fitur Layanan -->
                @include('home.beranda._hero')
            </div>
        </div>
        
        <!-- Bagian Sambutan Kepala Desa -->
        <div class="mt-5 mb-5">
            <div class="bg-white rounded-3 shadow-lg overflow-hidden border">
                <!-- Header dengan gradient -->
                <div class="bg-success py-4 px-4">
                    <h2 class="h3 fw-bold text-white d-flex align-items-center mb-0">
                        <i class="fas fa-seedling me-3 fs-4"></i>
                        Sambutan Kepala Desa
                    </h2>
                </div>
                
                <!-- Konten -->
                <div class="p-4 p-md-5">
                    <div class="text-center">
                        <!-- Icon sebagai pengganti foto -->
                        <div class="mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                <i class="fas fa-user-tie text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="mt-3 mb-1 fw-bold text-dark">Kepala Desa Sambangan</h4>
                            <p class="text-muted">Pemimpin Desa</p>
                        </div>
                        
                        <!-- Quote -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold text-dark mb-4 position-relative">
                                <i class="fas fa-quote-left text-success me-2"></i>
                                <span class="position-relative">Membangun Pertanian Berkelanjutan untuk Masa Depan yang Lebih Baik</span>
                                <i class="fas fa-quote-right text-success ms-2"></i>
                            </h3>
                        </div>
                        
                        <!-- Teks sambutan -->
                        <div class="mx-auto" style="max-width: 700px;">
                            <p class="fs-5 text-muted mb-4 lh-lg text-start">
                                Kami dengan bangga mempersembahkan portal edukasi pertanian terbaik bagi setiap petani dan masyarakat Desa Sambangan. Dengan semangat kebersamaan dan komitmen untuk kemajuan pertanian, kami terus berupaya memberikan informasi, teknologi, dan pengetahuan pertanian yang modern dan berkelanjutan.
                            </p>
                            
                            <p class="fs-5 text-muted mb-4 lh-lg text-start">
                                Mari bersama-sama membangun pertanian yang lebih maju, produktif, dan berkelanjutan untuk kesejahteraan masyarakat Desa Sambangan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
