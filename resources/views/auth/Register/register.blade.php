@extends('auth.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="auth-wrapper">
        <!-- Visual Side -->
        <div class="auth-visual">
            <div class="visual-content">
                <div class="visual-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h1 class="visual-title">Bergabung Bersama Kami</h1>
                <p class="visual-subtitle">Mulai perjalanan Anda dalam mengelola sistem edukasi pertanian</p>
            </div>

            <!-- Floating Elements -->
            <div class="floating-element" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
            <div class="floating-element" style="top: 60%; right: 15%; animation-delay: 2s;"></div>
            <div class="floating-element" style="bottom: 30%; left: 20%; animation-delay: 4s;"></div>
        </div>

        <!-- Form Side -->
        <div class="auth-form">
            <div class="auth-header">
                <div class="auth-logo">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Logo">
                </div>
                <h2 class="auth-title">Admin Website Edukasi Pertanian</h2>
                <p class="auth-subtitle">Buat akun baru Anda</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               id="nama"
                               name="nama"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap Anda"
                               required>
                    </div>
                    @error('nama')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Masukkan email Anda"
                               required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Masukkan password (min. 8 karakter)"
                               required>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text">
                        <small class="text-muted">Password minimal 8 karakter</small>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Daftar Akun
                    </button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
