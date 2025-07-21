<!-- Modern Navbar with Glassmorphism Effect -->
<header class="modern-navbar position-sticky top-0" style="z-index: 1030; backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); border-bottom: 1px solid rgba(40, 167, 69, 0.1); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center brand-hover" href="{{ route('beranda') }}" style="transition: all 0.3s ease;">
                <div class="logo-container position-relative me-3">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo agriedu"
                         class="logo-img"
                         style="width: 55px; height: 55px; object-fit: cover; border-radius: 16px; border: 3px solid transparent; background: linear-gradient(135deg, #28a745, #20c997); padding: 2px; transition: all 0.3s ease;" />
                    <div class="logo-glow position-absolute top-0 start-0 w-100 h-100 rounded-3"
                         style="background: linear-gradient(135deg, #28a745, #20c997); opacity: 0; transition: opacity 0.3s ease; z-index: -1; filter: blur(8px);"></div>
                </div>
                <div class="brand-text">
                    <h1 class="h4 mb-0 fw-bold" style="background: linear-gradient(135deg, #28a745, #20c997); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">agriedu</h1>
                    <span class="text-muted small fw-medium">Desa Sambangan</span>
                </div>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Menu Navigasi"
                style="background: linear-gradient(135deg, #28a745, #20c997); border-radius: 12px; transition: all 0.3s ease;">
                <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <!-- Beranda -->
                    <li class="nav-item mx-1">
                        <a class="nav-link modern-nav-link fw-semibold px-4 py-2 {{ request()->routeIs('beranda') ? 'active' : '' }}"
                           href="{{ route('beranda') }}"
                           style="border-radius: 25px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
                            <i class="fas fa-home me-2"></i>
                            <span>Beranda</span>
                        </a>
                    </li>

                    <!-- Artikel -->
                    <li class="nav-item mx-1">
                        <a class="nav-link modern-nav-link fw-semibold px-4 py-2 {{ request()->routeIs('frontend.artikel.*') ? 'active' : '' }}"
                           href="{{ route('frontend.artikel.index') }}"
                           style="border-radius: 25px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
                            <i class="fas fa-newspaper me-2"></i>
                            <span>Artikel</span>
                        </a>
                    </li>

                    <!-- Video & Media -->
                    <li class="nav-item mx-1">
                        <a class="nav-link modern-nav-link fw-semibold px-4 py-2 {{ request()->routeIs('frontend.multimedia.*') ? 'active' : '' }}"
                           href="{{ route('frontend.multimedia.index') }}"
                           style="border-radius: 25px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
                            <i class="fas fa-photo-video me-2"></i>
                            <span>Media</span>
                        </a>
                    </li>

                    <!-- Modul -->
                    <li class="nav-item mx-1">
                        <a class="nav-link modern-nav-link fw-semibold px-4 py-2 {{ request()->routeIs('frontend.modul.*') ? 'active' : '' }}"
                           href="{{ route('frontend.modul.index') }}"
                           style="border-radius: 25px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
                            <i class="fas fa-book me-2"></i>
                            <span>Modul</span>
                        </a>
                    </li>

                    <!-- Berita -->
                    <li class="nav-item mx-1">
                        <a class="nav-link modern-nav-link fw-semibold px-4 py-2 {{ request()->routeIs('frontend.berita.*') ? 'active' : '' }}"
                           href="{{ route('frontend.berita.index') }}"
                           style="border-radius: 25px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
                            <i class="fas fa-bullhorn me-2"></i>
                            <span>Berita</span>
                        </a>
                    </li>

                    <!-- Auth Section -->
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        @guest
                            <div class="d-flex flex-column flex-lg-row gap-2">
                                <a href='{{ route('login') }}'
                                   class='btn btn-modern-primary px-4 py-2 fw-semibold'
                                   style="border-radius: 25px; background: linear-gradient(135deg, #28a745, #20c997); border: none; color: white; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                </a>
                                <a href="{{ route('register') }}"
                                   class="btn btn-modern-outline px-4 py-2 fw-semibold"
                                   style="border-radius: 25px; border: 2px solid #28a745; color: #28a745; background: transparent; transition: all 0.3s ease;">
                                    <i class="fas fa-user-plus me-2"></i>Daftar
                                </a>
                            </div>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-modern-user px-4 py-2 d-flex align-items-center fw-semibold"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        style="border-radius: 25px; border: 2px solid rgba(40, 167, 69, 0.2); background: rgba(40, 167, 69, 0.05); color: #28a745; transition: all 0.3s ease;">
                                    <div class="user-avatar me-2 d-flex align-items-center justify-content-center"
                                         style="width: 32px; height: 32px; background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; color: white; font-size: 14px; font-weight: bold;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>
                                    <i class="fas fa-chevron-down ms-2 transition-icon" style="transition: transform 0.3s ease;"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end modern-dropdown shadow-lg border-0 mt-2"
                                    style="border-radius: 16px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); min-width: 200px;">
                                    <li>
                                        <div class="dropdown-header text-center py-3" style="background: linear-gradient(135deg, #28a745, #20c997); color: white; border-radius: 16px 16px 0 0; margin: -8px -8px 8px -8px;">
                                            <div class="user-avatar mx-auto mb-2" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                            <small class="opacity-75">{{ Auth::user()->email }}</small>
                                        </div>
                                    </li>
                                    @if(Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item d-flex align-items-center py-2 px-3"
                                           style="border-radius: 8px; margin: 0 8px; transition: all 0.3s ease; color: #28a745;">
                                            <i class="fas fa-cog me-3"></i>
                                            <span>Panel Admin</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center py-2 px-3"
                                                    style="border-radius: 8px; margin: 0 8px; transition: all 0.3s ease;">
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
.modern-navbar {
    transition: all 0.3s ease;
}

.brand-hover:hover .logo-glow {
    opacity: 0.3;
}

.brand-hover:hover .logo-img {
    transform: scale(1.05);
}

/* Navigation Links */
.modern-nav-link {
    color: #495057 !important;
    position: relative;
    font-weight: 600;
}

.modern-nav-link:not(.active):hover {
    color: #28a745 !important;
    background: rgba(40, 167, 69, 0.1) !important;
    transform: translateY(-2px);
}

.modern-nav-link.active {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

/* Button Hover Effects */
.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4) !important;
}

.btn-modern-outline:hover {
    background: #28a745 !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-modern-user:hover {
    background: rgba(40, 167, 69, 0.1) !important;
    border-color: #28a745 !important;
    transform: translateY(-2px);
}

.btn-modern-user:hover .transition-icon {
    transform: rotate(180deg);
}

/* Dropdown Styles */
.modern-dropdown {
    animation: dropdownFadeIn 0.3s ease;
}

@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-dropdown .dropdown-item:hover {
    background: rgba(220, 53, 69, 0.1) !important;
    color: #dc3545 !important;
}

/* Mobile Responsive */
@media (max-width: 991.98px) {
    .modern-navbar {
        background: rgba(255, 255, 255, 0.98) !important;
    }

    .navbar-collapse {
        background: white;
        border-radius: 16px;
        margin-top: 1rem;
        padding: 1rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .modern-nav-link {
        margin: 0.25rem 0;
        text-align: center;
    }
}

/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}
</style>
