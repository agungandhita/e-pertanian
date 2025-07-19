<header class="position-fixed top-0 start-0 end-0 bg-white border-bottom shadow-sm" style="z-index: 1040; height: 70px;">
    <div class="container-fluid h-100">
        <div class="row align-items-center h-100 px-2">
            <!-- Left Section: Logo & Toggle -->
            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <button id="sidebar-toggle" class="btn btn-light border me-3 d-lg-none rounded-3">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-flex align-items-center bg-light rounded-3 px-3 py-2">
                        <div class="position-relative me-2">
                            <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="rounded-2" style="width: 35px; height: 35px; object-fit: cover;">
                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle" style="width: 10px; height: 10px; border: 2px solid white;"></div>
                        </div>
                        <div class="d-none d-md-block">
                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">Admin Panel</div>
                            <small class="text-muted">Website Edukasi Pertanian</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Center Section: Search or Breadcrumb (Optional) -->
            <div class="col d-none d-lg-block">
                <div class="text-center">
                    <span class="text-muted" style="font-size: 0.85rem;">{{ now()->format('l, d F Y') }}</span>
                </div>
            </div>

            <!-- Right Section: Notifications & Profile -->
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2">
                    <!-- Notification Button -->
                    {{-- <div class="position-relative">
                        <button id="notification-toggle" class="btn btn-light border position-relative rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; transform: translate(-50%, -50%) !important;">3</span>
                        </button>
                        {{-- @include('admin.partials.norifikasi') --}}
                    {{-- </div>  --}}

                    <!-- Profile Card -->
                    <div class="bg-light rounded-3 p-2 d-flex align-items-center">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                            <i class="fas fa-user-shield text-white" style="font-size: 0.9rem;"></i>
                        </div>
                        <div class="d-none d-sm-block me-2">
                            <div class="fw-medium text-dark" style="font-size: 0.85rem;">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <small class="text-muted">Administrator</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
