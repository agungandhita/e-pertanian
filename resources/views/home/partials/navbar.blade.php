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
                            <i class="fas fa-home"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.artikel.*') ? 'active' : '' }}" href="{{ route('frontend.artikel.index') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>Artikel</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.multimedia.*') ? 'active' : '' }}" href="{{ route('frontend.multimedia.index') }}">
                            <i class="fas fa-photo-video"></i>
                            <span>Media</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.modul.*') ? 'active' : '' }}" href="{{ route('frontend.modul.index') }}">
                            <i class="fas fa-book"></i>
                            <span>Modul</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.berita.*') ? 'active' : '' }}" href="{{ route('frontend.berita.index') }}">
                            <i class="fas fa-bullhorn"></i>
                            <span>Berita</span>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->routeIs('frontend.products.*') ? 'active' : '' }}" href="{{ route('frontend.products.index') }}">
                            <i class="fas fa-seedling"></i>
                            <span>Produk</span>
                        </a>
                    </li>

                    @auth
                    <li class="nav-item mx-1">
                        <a class="nav-link position-relative {{ request()->routeIs('frontend.cart.*') ? 'active' : '' }}" href="{{ route('frontend.cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Keranjang</span>
                            <span id="cart-count" class="badge bg-danger rounded-pill">0</span>
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
                            <div class="dropdown user-profile-dropdown">
                                <button class="btn btn-outline-success btn-sm dropdown-toggle px-4 py-2 user-dropdown d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-avatar me-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        <span class="user-name">{{ Str::limit(Auth::user()->name, 15) }}</span>
                                        <small class="user-role d-block">{{ ucfirst(Auth::user()->role ?? 'User') }}</small>
                                    </div>
                                    <i class="fas fa-chevron-down ms-2 dropdown-arrow"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 user-menu">
                                    <li class="dropdown-header-custom">
                                        <div class="user-header-info">
                                            <div class="user-avatar-large">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="user-details">
                                                <h6 class="user-full-name">{{ Auth::user()->name }}</h6>
                                                <small class="user-email">{{ Auth::user()->email }}</small>
                                                <span class="user-badge">{{ ucfirst(Auth::user()->role ?? 'User') }}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li><hr class="dropdown-divider my-2"></li>
                                    <li>
                                        <a href="{{ route('frontend.orders.index') }}" class="dropdown-item py-3 menu-item">
                                            <div class="menu-icon">
                                                <i class="fas fa-shopping-bag"></i>
                                            </div>
                                            <div class="menu-content">
                                                <span class="menu-title">Pesanan Saya</span>
                                                <small class="menu-desc">Lihat riwayat pesanan</small>
                                            </div>
                                            <i class="fas fa-chevron-right menu-arrow"></i>
                                        </a>
                                    </li>
                                    @if(Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item py-3 menu-item">
                                            <div class="menu-icon admin-icon">
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <div class="menu-content">
                                                <span class="menu-title">Panel Admin</span>
                                                <small class="menu-desc">Kelola sistem</small>
                                            </div>
                                            <i class="fas fa-chevron-right menu-arrow"></i>
                                        </a>
                                    </li>
                                    @endif
                                    <li><hr class="dropdown-divider my-2"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item py-3 logout-btn menu-item w-100 text-start">
                                                <div class="menu-icon logout-icon">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </div>
                                                <div class="menu-content">
                                                    <span class="menu-title">Keluar</span>
                                                    <small class="menu-desc">Logout dari akun</small>
                                                </div>
                                                <i class="fas fa-chevron-right menu-arrow"></i>
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
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
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
    width: 16px;
    height: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.5rem !important;
}

.nav-link:hover i {
    transform: scale(1.1);
}

.nav-link span {
    display: inline-block;
    line-height: 1;
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
.user-profile-dropdown {
    position: relative;
}

.user-dropdown {
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid #28a745;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    min-width: 200px;
    position: relative;
    overflow: hidden;
}

.user-dropdown::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.1), transparent);
    transition: left 0.5s ease;
}

.user-dropdown:hover::before {
    left: 100%;
}

.user-dropdown:hover {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    border-color: #20c997;
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #28a745, #20c997);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    transition: all 0.3s ease;
}

.user-dropdown:hover .user-avatar {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.user-info {
    text-align: left;
    line-height: 1.2;
}

.user-name {
    font-weight: 600;
    font-size: 0.9rem;
    display: block;
}

.user-role {
    font-size: 0.75rem;
    opacity: 0.8;
    font-weight: 400;
}

.dropdown-arrow {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.user-dropdown[aria-expanded="true"] .dropdown-arrow {
    transform: rotate(180deg);
}

.user-menu {
    border-radius: 16px;
    padding: 0;
    margin-top: 0.75rem;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(40, 167, 69, 0.1);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    min-width: 280px;
    overflow: hidden;
    animation: dropdownSlide 0.3s ease-out;
}

@keyframes dropdownSlide {
    from {
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.dropdown-header-custom {
    padding: 1.5rem 1.25rem 1rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-bottom: 1px solid rgba(40, 167, 69, 0.1);
}

.user-header-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar-large {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #28a745, #20c997);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.user-details {
    flex: 1;
}

.user-full-name {
    margin: 0;
    font-size: 1rem;
    font-weight: 700;
    color: #2d3748;
    line-height: 1.2;
}

.user-email {
    color: #718096;
    font-size: 0.8rem;
    display: block;
    margin-top: 2px;
}

.user-badge {
    display: inline-block;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    font-size: 0.7rem;
    padding: 2px 8px;
    border-radius: 12px;
    font-weight: 600;
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.menu-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.25rem !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    background: none;
    text-decoration: none;
    color: #4a5568;
    position: relative;
    overflow: hidden;
}

.menu-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.05), transparent);
    transition: left 0.4s ease;
}

.menu-item:hover::before {
    left: 100%;
}

.menu-item:hover {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.08), rgba(40, 167, 69, 0.04));
    color: #2d3748;
    transform: translateX(8px);
    text-decoration: none;
}

.menu-icon {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    transition: all 0.3s ease;
    color: #4a5568;
}

.menu-item:hover .menu-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    transform: scale(1.1);
}

.admin-icon {
    background: linear-gradient(135deg, #ffd93d, #ff9500) !important;
    color: white !important;
}

.logout-icon {
    background: linear-gradient(135deg, #fed7d7, #feb2b2) !important;
    color: #e53e3e !important;
}

.menu-content {
    flex: 1;
    text-align: left;
}

.menu-title {
    font-weight: 600;
    font-size: 0.9rem;
    display: block;
    line-height: 1.2;
}

.menu-desc {
    color: #a0aec0;
    font-size: 0.75rem;
    display: block;
    margin-top: 2px;
}

.menu-arrow {
    font-size: 0.8rem;
    color: #cbd5e0;
    transition: all 0.3s ease;
}

.menu-item:hover .menu-arrow {
    color: #28a745;
    transform: translateX(4px);
}

.logout-btn {
    border: none;
    width: 100%;
    text-align: left;
}

.logout-btn:hover {
    background: linear-gradient(135deg, rgba(229, 62, 62, 0.08), rgba(229, 62, 62, 0.04)) !important;
    color: #e53e3e !important;
}

.logout-btn:hover .menu-icon {
    background: linear-gradient(135deg, #e53e3e, #c53030) !important;
    color: white !important;
}

.logout-btn:hover .menu-arrow {
    color: #e53e3e !important;
}

/* Cart Badge */
.nav-link.position-relative {
    position: relative !important;
}

#cart-count {
    font-size: 0.7rem;
    min-width: 18px;
    height: 18px;
    line-height: 18px;
    animation: pulse 2s infinite;
    top: -8px !important;
    right: -8px !important;
    transform: none !important;
    position: absolute !important;
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
        justify-content: flex-start;
        padding: 0.75rem 1rem !important;
    }
    
    .nav-link i {
        margin-right: 0.75rem !important;
        width: 18px;
        height: 18px;
    }

    .auth-buttons {
        justify-content: center;
        margin-top: 1rem;
    }

    .nav-item.ms-4 {
        margin-left: 0 !important;
    }

    .user-dropdown {
        min-width: 100%;
        justify-content: center;
    }

    .user-info {
        display: block !important;
        text-align: center;
    }

    .user-menu {
        min-width: 100%;
        margin-top: 0.5rem;
        left: 0 !important;
        right: 0 !important;
        transform: none !important;
    }

    .dropdown-header-custom {
        padding: 1rem;
    }

    .user-header-info {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }

    .user-details {
        text-align: center;
    }

    .menu-item {
        padding: 1rem 1.25rem !important;
    }

    .menu-icon {
        width: 40px;
        height: 40px;
    }
}

@media (max-width: 576px) {
    .user-dropdown {
        padding: 0.5rem 1rem !important;
        font-size: 0.85rem;
    }

    .user-avatar {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }

    .user-name {
        font-size: 0.8rem;
    }

    .user-role {
        font-size: 0.7rem;
    }

    .user-menu {
        margin-top: 0.25rem;
    }

    .user-avatar-large {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }

    .user-full-name {
        font-size: 0.9rem;
    }

    .user-email {
        font-size: 0.75rem;
    }

    .menu-title {
        font-size: 0.85rem;
    }

    .menu-desc {
        font-size: 0.7rem;
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
