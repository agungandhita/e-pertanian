<!-- Modern Clean Navbar -->
<header class="navbar-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient-light">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center brand-hover" href="{{ route('beranda') }}">
                <div class="logo-container me-3">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo agriedu" class="logo">
                </div>
                <div class="brand-text">
                    <h5 class="mb-0 text-success fw-bold brand-title">agriedu</h5>
                    <small class="text-muted brand-subtitle">Desa Sambangan</small>
                </div>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
                            <i class="fas fa-home me-2"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.artikel.*') ? 'active' : '' }}" href="{{ route('frontend.artikel.index') }}">
                            <i class="fas fa-newspaper me-2"></i>
                            <span>Artikel</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.multimedia.*') ? 'active' : '' }}" href="{{ route('frontend.multimedia.index') }}">
                            <i class="fas fa-photo-video me-2"></i>
                            <span>Media</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.modul.*') ? 'active' : '' }}" href="{{ route('frontend.modul.index') }}">
                            <i class="fas fa-book me-2"></i>
                            <span>Modul</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.berita.*') ? 'active' : '' }}" href="{{ route('frontend.berita.index') }}">
                            <i class="fas fa-bullhorn me-2"></i>
                            <span>Berita</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.products.*') ? 'active' : '' }}" href="{{ route('frontend.products.index') }}">
                            <i class="fas fa-seedling me-2"></i>
                            <span>Produk</span>
                        </a>
                    </li>

                    @auth
                    <li class="nav-item mx-1">
                        <a class="nav-link position-relative {{ request()->routeIs('frontend.cart.*') ? 'active' : '' }}" href="{{ route('frontend.cart.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i>
                            <span>Keranjang</span>
                            <span id="cart-count" class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">0</span>
                        </a>
                    </li>
                    @endauth

                    <!-- Auth Section -->
                    <li class="nav-item ms-4">
                        @guest
                            <div class="d-flex gap-2 auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-success btn-sm px-3 py-2 auth-btn">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    <span>Masuk</span>
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm px-3 py-2 auth-btn">
                                    <i class="fas fa-user-plus me-2"></i>
                                    <span>Daftar</span>
                                </a>
                            </div>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-outline-success btn-sm dropdown-toggle px-3 py-2 user-dropdown" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i>
                                    <span>{{ Str::limit(Auth::user()->name, 12) }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 user-menu">
                                    <li><h6 class="dropdown-header text-success fw-bold">{{ Auth::user()->name }}</h6></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a href="{{ route('frontend.orders.index') }}" class="dropdown-item py-2">
                                            <i class="fas fa-shopping-bag me-3 text-primary"></i>
                                            <span>Pesanan Saya</span>
                                        </a>
                                    </li>
                                    @if(Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item py-2">
                                            <i class="fas fa-cog me-3 text-warning"></i>
                                            <span>Panel Admin</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2 logout-btn">
                                                <i class="fas fa-sign-out-alt me-3"></i>
                                                <span>Keluar</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
/* Modern Navbar Styles */
.navbar-header {
    position: sticky;
    top: 0;
    z-index: 1030;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.bg-gradient-light {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
}

/* Brand Styling */
.brand-hover {
    transition: all 0.3s ease;
    text-decoration: none;
}

.brand-hover:hover {
    transform: translateY(-1px);
    text-decoration: none;
}

.logo-container {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
    transition: all 0.3s ease;
}

.logo-container:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
}

.logo {
    width: 45px;
    height: 45px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.brand-title {
    font-size: 1.4rem;
    letter-spacing: -0.5px;
    transition: all 0.3s ease;
}

.brand-subtitle {
    font-size: 0.85rem;
    opacity: 0.8;
    transition: all 0.3s ease;
}

.brand-hover:hover .brand-title {
    color: #198754 !important;
}

.brand-hover:hover .brand-subtitle {
    opacity: 1;
    color: #6c757d !important;
}

/* Navigation Links */
.nav-link {
    color: #495057 !important;
    font-weight: 500;
    padding: 0.75rem 1.25rem !important;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    margin: 0 2px;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.1), transparent);
    transition: left 0.5s ease;
}

.nav-link:hover::before {
    left: 100%;
}

.nav-link:hover {
    color: #198754 !important;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
}

.nav-link.active {
    color: #ffffff !important;
    background: linear-gradient(135deg, #28a745, #20c997);
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    transform: translateY(-1px);
}

.nav-link.active:hover {
    background: linear-gradient(135deg, #20c997, #28a745);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.5);
}

.nav-link i {
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.nav-link:hover i {
    transform: scale(1.1);
}

/* Auth Buttons */
.auth-btn {
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.auth-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.auth-btn:hover::before {
    left: 100%;
}

.btn-success.auth-btn {
    background: linear-gradient(135deg, #28a745, #20c997);
    border-color: #28a745;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-success.auth-btn:hover {
    background: linear-gradient(135deg, #20c997, #17a2b8);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.btn-outline-success.auth-btn {
    border-color: #28a745;
    color: #28a745;
    background: transparent;
}

.btn-outline-success.auth-btn:hover {
    background: linear-gradient(135deg, #28a745, #20c997);
    border-color: #28a745;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

/* User Dropdown */
.user-dropdown {
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 2px solid #28a745;
    background: transparent;
}

.user-dropdown:hover {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.user-menu {
    border-radius: 12px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    background: white;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.user-menu .dropdown-item {
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 0 0.5rem;
    font-weight: 500;
}

.user-menu .dropdown-item:hover {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
    transform: translateX(5px);
    color: #198754;
}

.logout-btn:hover {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05)) !important;
    color: #dc3545 !important;
}

/* Cart Badge */
#cart-count {
    font-size: 0.7rem;
    min-width: 18px;
    height: 18px;
    line-height: 18px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Mobile Responsive */
@media (max-width: 991.98px) {
    .navbar-collapse {
        margin-top: 1rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .nav-link {
        margin: 0.25rem 0;
        text-align: center;
    }
    
    .auth-buttons {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .nav-item.ms-4 {
        margin-left: 0 !important;
    }
}

/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}

/* Loading animation for navbar */
.navbar-header {
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
