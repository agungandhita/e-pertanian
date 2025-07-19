<!-- Sidebar -->
<aside id="sidebar" class="sidebar bg-white shadow-sm position-fixed top-0 start-0 h-100 d-none d-lg-block" style="width: 260px; z-index: 1050; transition: transform 0.3s ease; margin-top: 70px;">

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav p-3 h-100 d-flex flex-column">
        <!-- Dashboard Section -->
        <div class="mb-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center py-3 px-3 rounded-3 text-decoration-none {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-dark bg-light' }} border">
                <div class="d-flex align-items-center justify-content-center rounded-circle me-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-primary' : 'bg-primary text-white' }}" style="width: 35px; height: 35px;">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div>
                    <div class="fw-bold">Dashboard</div>
                    <small class="opacity-75">Panel Utama</small>
                </div>
            </a>
        </div>

        <!-- Management Section -->
        <div class="mb-3">
            <h6 class="text-muted text-uppercase fw-bold mb-2 px-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">Manajemen Sistem</h6>
            <div class="bg-light rounded-3 p-2">
                <a href="{{ route('admin.users.index') }}" class="nav-link d-flex align-items-center py-2 px-2 rounded mb-1 text-decoration-none {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white' : 'text-dark' }}">
                    <i class="fas fa-users me-2" style="width: 16px;"></i>
                    <span style="font-size: 0.9rem;">Kelola Pengguna</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="nav-link d-flex align-items-center py-2 px-2 rounded text-decoration-none {{ request()->routeIs('admin.kategori.*') ? 'bg-primary text-white' : 'text-dark' }}">
                    <i class="fas fa-tags me-2" style="width: 16px;"></i>
                    <span style="font-size: 0.9rem;">Kelola Kategori</span>
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="mb-3">
            <h6 class="text-muted text-uppercase fw-bold mb-2 px-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">Manajemen Konten</h6>
            <div class="bg-light rounded-3 p-2">
                <a href="{{ route('admin.artikel.index') }}" class="nav-link d-flex align-items-center py-2 px-2 rounded mb-1 text-decoration-none {{ request()->routeIs('admin.artikel.*') ? 'bg-primary text-white' : 'text-dark' }}">
                    <i class="fas fa-newspaper me-2" style="width: 16px;"></i>
                    <span style="font-size: 0.9rem;">Kelola Artikel</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="nav-link d-flex align-items-center py-2 px-2 rounded mb-1 text-decoration-none {{ request()->routeIs('admin.berita.*') ? 'bg-primary text-white' : 'text-dark' }}">
                    <i class="fas fa-bullhorn me-2" style="width: 16px;"></i>
                    <span style="font-size: 0.9rem;">Kelola Berita</span>
                </a>
                <a href="{{ route('admin.multimedia.index') }}" class="nav-link d-flex align-items-center py-2 px-2 rounded mb-1 text-decoration-none {{ request()->routeIs('admin.multimedia.*') ? 'bg-primary text-white' : 'text-dark' }}">
                    <i class="fas fa-photo-video me-2" style="width: 16px;"></i>
                    <span style="font-size: 0.9rem;">Kelola Multimedia</span>
                </a>
                <a href="{{ route('admin.modul.index') }}" class="nav-link d-flex align-items-center py-2 px-2 rounded text-decoration-none {{ request()->routeIs('admin.modul.*') ? 'bg-primary text-white' : 'text-dark' }}">
                    <i class="fas fa-book me-2" style="width: 16px;"></i>
                    <span style="font-size: 0.9rem;">Kelola Modul</span>
                </a>
            </div>
        </div>

        <!-- Spacer -->
        <div class="flex-grow-1"></div>

        <!-- Logout Button -->
        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center py-2 rounded-3">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    <span class="fw-medium">Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="position-absolute bottom-0 start-0 end-0 p-3 border-top bg-light">
        <div class="d-flex align-items-center p-2 bg-white rounded shadow-sm">
            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                <i class="fas fa-user-shield text-white" style="font-size: 0.875rem;"></i>
            </div>
            <div class="flex-grow-1 text-truncate">
                <p class="mb-0 fw-medium" style="font-size: 0.875rem;">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="mb-0 text-muted" style="font-size: 0.75rem;">Administrator</p>
            </div>
        </div>
    </div>
</aside>
