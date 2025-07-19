@extends('home.layouts.main')

@section('container')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.modul.index') }}" class="text-decoration-none">Modul</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($modul->judul, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Modul Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <!-- Modul Header -->
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark mb-2">
                            <i class="fas fa-file-pdf me-1"></i>Modul PDF
                        </span>
                    </div>
                    <h1 class="card-title h2 fw-bold text-dark mb-3">{{ $modul->judul }}</h1>
                    
                    <!-- Modul Meta -->
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>{{ $modul->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $modul->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <i class="fas fa-book me-2"></i>
                            <span>Modul Pembelajaran</span>
                        </div>
                    </div>
                </div>

                <!-- PDF Preview -->
                <div class="px-4">
                    <div class="position-relative overflow-hidden rounded bg-warning bg-opacity-10">
                        @if($modul->file_path)
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-file-pdf fa-5x text-warning"></i>
                                </div>
                                <h4 class="text-warning fw-bold mb-3">{{ $modul->judul }}</h4>
                                <p class="text-muted mb-4">Modul pembelajaran dalam format PDF siap untuk diunduh</p>
                                
                                <!-- Download Buttons -->
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('frontend.modul.download', $modul) }}" class="btn btn-warning btn-lg">
                                        <i class="fas fa-download me-2"></i>Unduh Modul
                                    </a>
                                    <button onclick="openPDFViewer()" class="btn btn-outline-warning btn-lg">
                                        <i class="fas fa-eye me-2"></i>Pratinjau
                                    </button>
                                </div>
                                
                                <!-- File Info -->
                                <div class="mt-4 text-muted small">
                                    <i class="fas fa-info-circle me-1"></i>
                                    File PDF • Dapat diunduh • Untuk pembelajaran offline
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-file-pdf fa-5x text-muted"></i>
                                </div>
                                <h4 class="text-muted mb-3">File Tidak Tersedia</h4>
                                <p class="text-muted">Maaf, file modul belum tersedia untuk diunduh</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Modul Description -->
                <div class="card-body px-4 pb-4">
                    <div class="modul-content">
                        <h5 class="fw-bold mb-3">Deskripsi Modul</h5>
                        <div class="text-muted mb-4">
                            {!! nl2br(e($modul->deskripsi)) !!}
                        </div>
                        
                        <!-- Learning Objectives -->
                        <div class="bg-light p-4 rounded mb-4">
                            <h6 class="fw-bold text-warning mb-3">
                                <i class="fas fa-bullseye me-2"></i>Tujuan Pembelajaran
                            </h6>
                            <ul class="mb-0 text-muted">
                                <li>Memahami konsep dasar pertanian modern</li>
                                <li>Menguasai teknik-teknik pertanian yang efektif</li>
                                <li>Mengaplikasikan pengetahuan dalam praktik sehari-hari</li>
                                <li>Meningkatkan produktivitas dan kualitas hasil pertanian</li>
                            </ul>
                        </div>
                        
                        <!-- How to Use -->
                        <div class="border border-warning rounded p-4 mb-4">
                            <h6 class="fw-bold text-warning mb-3">
                                <i class="fas fa-lightbulb me-2"></i>Cara Menggunakan Modul
                            </h6>
                            <ol class="mb-0 text-muted">
                                <li>Unduh file PDF dengan mengklik tombol "Unduh Modul"</li>
                                <li>Buka file menggunakan aplikasi pembaca PDF</li>
                                <li>Pelajari materi secara bertahap sesuai urutan</li>
                                <li>Praktikkan pengetahuan yang didapat</li>
                                <li>Diskusikan dengan sesama petani untuk berbagi pengalaman</li>
                            </ol>
                        </div>
                    </div>
                    
                    <!-- Modul Footer -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Modul pembelajaran untuk edukasi pertanian
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <button onclick="shareModul()" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-share-alt me-1"></i>Bagikan
                            </button>
                            @if($modul->file_path)
                                <a href="{{ route('frontend.modul.download', $modul) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-download me-1"></i>Unduh
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Modul Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Modul
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-muted mb-1">Dipublikasi</h6>
                                <p class="mb-0 fw-bold">{{ $modul->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Format</h6>
                            <p class="mb-0 fw-bold">PDF</p>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h6 class="text-muted mb-1">Status</h6>
                        @if($modul->file_path)
                            <span class="badge bg-success">Tersedia untuk Diunduh</span>
                        @else
                            <span class="badge bg-secondary">Belum Tersedia</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Download Stats -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistik
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-download fa-2x text-info mb-2"></i>
                        <h4 class="fw-bold text-info">{{ rand(50, 500) }}</h4>
                        <small class="text-muted">Total Unduhan</small>
                    </div>
                </div>
            </div>

            <!-- Related Links -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-link me-2"></i>Konten Terkait
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('frontend.artikel.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-newspaper me-2"></i>Artikel Edukasi
                        </a>
                        <a href="{{ route('frontend.multimedia.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-play-circle me-2"></i>Multimedia Edukasi
                        </a>
                        <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-bullhorn me-2"></i>Berita Terbaru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDF Viewer Modal -->
<div class="modal fade" id="pdfViewerModal" tabindex="-1" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfViewerModalLabel">
                    <i class="fas fa-file-pdf me-2 text-warning"></i>{{ $modul->judul }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                @if($modul->file_path)
                    <iframe src="{{ asset('storage/modul/files/' . $modul->file_path) }}" 
                            width="100%" height="600px" frameborder="0">
                        Browser Anda tidak mendukung pratinjau PDF.
                    </iframe>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('frontend.modul.download', $modul) }}" class="btn btn-warning">
                    <i class="fas fa-download me-1"></i>Unduh Modul
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.modul-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2c3e50;
    text-align: justify;
}

.modul-content p {
    margin-bottom: 1.5rem;
}

.breadcrumb-item a {
    color: #007bff;
}

.breadcrumb-item.active {
    color: #6c757d;
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn-warning {
    background: linear-gradient(45deg, #ffc107, #ffb300);
    border: none;
    color: #212529;
}

.btn-warning:hover {
    background: linear-gradient(45deg, #e0a800, #ff8f00);
    color: #212529;
}

.btn-outline-warning {
    border-color: #ffc107;
    color: #ffc107;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

@media print {
    .breadcrumb, .btn, .card-header, nav, .modal {
        display: none !important;
    }
    
    .container {
        max-width: 100% !important;
    }
    
    .col-lg-4 {
        display: none !important;
    }
    
    .col-lg-8 {
        width: 100% !important;
    }
}
</style>

<!-- JavaScript -->
<script>
function shareModul() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $modul->judul }}',
            text: '{{ Str::limit($modul->deskripsi, 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link modul telah disalin ke clipboard!');
        });
    }
}

function openPDFViewer() {
    @if($modul->file_path)
        const modal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
        modal.show();
    @else
        alert('File PDF tidak tersedia untuk pratinjau.');
    @endif
}
</script>
@endsection