<footer class="bg-success text-white py-5 mt-5">
    <div class="container">
        <!-- Footer Top Section -->
        <div class="row mb-4">
            <!-- Logo & About -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo Website Edukasi Pertanian"
                        class="me-3" style="width: 70px; height: 70px; object-fit: cover; border-radius: 12px; border: 2px solid white;" />
                    <div>
                        <h3 class="h4 fw-bold mb-1">EDUKASI PERTANIAN</h3>
                        <p class="mb-0 opacity-90">Desa Sambangan</p>
                    </div>
                </div>
                <p class="fs-5 text-light mb-4 lh-lg">
                    Portal edukasi pertanian untuk masyarakat Desa Sambangan. Kami berkomitmen
                    untuk memberikan informasi dan edukasi pertanian terbaik bagi seluruh petani dan masyarakat.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white p-2 rounded-circle bg-white bg-opacity-20 hover-lift" title="Facebook">
                        <i class="fab fa-facebook-f fa-lg"></i>
                    </a>
                    <a href="#" class="text-white p-2 rounded-circle bg-white bg-opacity-20 hover-lift" title="Instagram">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-white p-2 rounded-circle bg-white bg-opacity-20 hover-lift" title="WhatsApp">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                    <a href="#" class="text-white p-2 rounded-circle bg-white bg-opacity-20 hover-lift" title="YouTube">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h4 class="h5 fw-bold mb-4 border-bottom border-light pb-2">Menu Utama</h4>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="{{ route('beranda') }}" class="text-light text-decoration-none d-flex align-items-center fs-5 hover-link">
                            <i class="fas fa-home me-3"></i>
                            Beranda
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('frontend.artikel.index') }}" class="text-light text-decoration-none d-flex align-items-center fs-5 hover-link">
                            <i class="fas fa-newspaper me-3"></i>
                            Artikel Pertanian
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('frontend.multimedia.index') }}" class="text-light text-decoration-none d-flex align-items-center fs-5 hover-link">
                            <i class="fas fa-photo-video me-3"></i>
                            Video & Media
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('frontend.modul.index') }}" class="text-light text-decoration-none d-flex align-items-center fs-5 hover-link">
                            <i class="fas fa-book me-3"></i>
                            Modul Belajar
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('frontend.berita.index') }}" class="text-light text-decoration-none d-flex align-items-center fs-5 hover-link">
                            <i class="fas fa-bullhorn me-3"></i>
                            Edukasi Pertanian
                        </a>
                    </li>
                    {{-- <li class="mb-2">
                        <a href="{{ route('layanan') }}" class="text-light text-decoration-none d-flex align-items-center">
                            <i class="fas fa-tools me-2"></i>
                            Layanan
                        </a>
                    </li> --}}
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h4 class="h5 fw-bold mb-4 border-bottom border-light pb-2">Kontak Kami</h4>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-warning me-3 mt-1 fs-5"></i>
                        <span class="text-light">Desa Sambangan, Kecamatan Sambangan, Indonesia</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-envelope text-warning me-3 fs-5"></i>
                        <a href="mailto:info@sambangan.desa.id" class="text-light text-decoration-none hover-link">info@sambangan.desa.id</a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-phone text-warning me-3 fs-5"></i>
                        <a href="tel:+6285123456789" class="text-light text-decoration-none hover-link">(+62) 851-2345-6789</a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-clock text-warning me-3 fs-5"></i>
                        <span class="text-light">Senin - Jumat: 08:00 - 16:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <hr class="border-light my-4">

        <!-- Footer Bottom -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-light mb-0">
                    &copy; {{ date('Y') }} EDUKASI PERTANIAN Desa Sambangan. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-light mb-0">
                    Made with <i class="fas fa-heart text-danger"></i> by Tim Edukasi Pertanian
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
.hover-link {
    transition: all 0.3s ease;
}

.hover-link:hover {
    color: #ffc107 !important;
    transform: translateX(5px);
}

.social-icon {
    transition: all 0.3s ease;
}

.social-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .footer-logo {
        width: 60px !important;
        height: 60px !important;
    }
    
    .fs-5 {
        font-size: 1.1rem !important;
    }
    
    .h5 {
        font-size: 1.2rem !important;
    }
}
</style>
