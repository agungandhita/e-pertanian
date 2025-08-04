@extends('admin.layouts.main')

@section('title', 'Tambah Multimedia - Admin Panel')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-plus-circle text-primary me-2"></i>Tambah Multimedia Baru
            </h1>
            <p class="text-muted mb-0">Upload dan kelola file multimedia agriedu</p>
        </div>
        <a href="{{ route('admin.multimedia.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-upload me-2"></i>Form Upload Multimedia
                    </h5>
                </div>
            <form action="{{ route('admin.multimedia.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4">
                    <!-- Alert Info -->
                    <div class="alert alert-info border-0 mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Petunjuk:</strong> Pilih kategori yang sesuai dan masukkan URL YouTube untuk video multimedia.
                    </div>

                    <div class="mb-4">
                        <label for="kategori_id" class="form-label fw-bold">
                            <i class="fas fa-tags text-primary me-2"></i>Kategori <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-lg @error('kategori_id') is-invalid @enderror"
                                id="kategori_id" name="kategori_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold">
                            <i class="fas fa-align-left text-info me-2"></i>Deskripsi Multimedia <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="5" required
                                  placeholder="Masukkan deskripsi yang jelas dan menarik tentang konten multimedia ini...">{{ old('deskripsi') }}</textarea>
                        <div class="form-text">
                            <i class="fas fa-lightbulb text-warning me-1"></i>
                            Berikan deskripsi yang informatif dan menarik untuk membantu pengguna memahami konten.
                        </div>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- YouTube URL -->
                    <div class="mb-4">
                        <label for="youtube_url" class="form-label fw-bold">
                            <i class="fab fa-youtube text-danger me-2"></i>URL YouTube <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-danger text-white">
                                <i class="fab fa-youtube"></i>
                            </span>
                            <input type="url" class="form-control @error('youtube_url') is-invalid @enderror"
                                   id="youtube_url" name="youtube_url" value="{{ old('youtube_url') }}" required
                                   placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle text-info me-1"></i>
                            Masukkan URL YouTube yang valid untuk video multimedia.
                        </div>
                        @error('youtube_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                </div>

                <div class="card-footer bg-light border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button type="submit" class="btn btn-success btn-lg me-3">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Upload Multimedia
                            </button>
                            <a href="{{ route('admin.multimedia.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                        <div class="text-muted">
                            <small><i class="fas fa-info-circle me-1"></i>Pastikan semua field telah diisi dengan benar</small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Panduan Upload -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-lightbulb me-2"></i>Panduan Upload
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success border-0">
                        <h6 class="alert-heading fw-bold">
                            <i class="fas fa-check-circle me-2"></i>Tips Sukses Upload:
                        </h6>
                        <ul class="mb-0 mt-3">
                            <li class="mb-2"><i class="fas fa-arrow-right text-success me-2"></i>Pastikan file tidak melebihi 2MB</li>
                            <li class="mb-2"><i class="fas fa-arrow-right text-success me-2"></i>Gunakan format file yang didukung</li>
                            <li class="mb-2"><i class="fas fa-arrow-right text-success me-2"></i>Berikan deskripsi yang jelas dan menarik</li>
                            <li class="mb-0"><i class="fas fa-arrow-right text-success me-2"></i>Pilih kategori yang sesuai</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning border-0">
                        <h6 class="alert-heading fw-bold">
                            <i class="fas fa-exclamation-triangle me-2"></i>Penting untuk Diperhatikan:
                        </h6>
                        <ul class="mb-0 mt-3">
                            <li class="mb-2"><i class="fas fa-globe text-warning me-2"></i>File akan tersedia untuk publik</li>
                            <li class="mb-2"><i class="fas fa-shield-alt text-warning me-2"></i>Pastikan konten sesuai kebijakan</li>
                            <li class="mb-0"><i class="fas fa-clock text-warning me-2"></i>Proses upload membutuhkan waktu</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Statistik Quick -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-success text-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar me-2"></i>Info Multimedia
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary fw-bold">{{ \App\Models\Multimedia::count() }}</h4>
                                <small class="text-muted">Total Media</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success fw-bold">{{ \App\Models\Kategori::count() }}</h4>
                            <small class="text-muted">Kategori</small>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="{{ route('admin.multimedia.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list me-1"></i>Lihat Semua Media
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
}

.upload-area {
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9fa !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.alert {
    border-radius: 10px;
}

.badge {
    border-radius: 20px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const kategoriId = document.getElementById('kategori_id').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const youtubeUrl = document.getElementById('youtube_url').value;

        if (!kategoriId || !deskripsi.trim() || !youtubeUrl.trim()) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap!',
                text: 'Mohon lengkapi semua field yang wajib diisi.',
                confirmButtonColor: '#ffc107'
            });
            return;
        }

        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu, data sedang disimpan.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });
});
</script>
@endpush
