@extends('home.layouts.main')

@section('head')
<meta name="multimedia-id" content="{{ $multimedia->id }}">
@endsection

@section('container')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.multimedia.index') }}" class="text-decoration-none">Multimedia</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($multimedia->deskripsi, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Multimedia Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <!-- Multimedia Header -->
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="mb-3">
                        <span class="badge bg-danger mb-2">
                            <i class="fab fa-youtube me-1"></i>Video YouTube
                        </span>
                    </div>
                    <h1 class="card-title h2 fw-bold text-dark mb-3">{{ $multimedia->deskripsi }}</h1>

                    <!-- Multimedia Meta -->
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>{{ $multimedia->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $multimedia->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <i class="fab fa-youtube me-2"></i>
                            <span>Video YouTube</span>
                        </div>
                    </div>
                </div>

                <!-- Multimedia Content -->
                <div class="px-4">
                    <div class="position-relative overflow-hidden rounded">
                        @if($multimedia->youtube_url)
                            @php
                                $youtube_id = '';
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $multimedia->youtube_url, $matches)) {
                                    $youtube_id = $matches[1];
                                }
                            @endphp
                            @if($youtube_id)
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}"
                                            title="YouTube video"
                                            allowfullscreen
                                            class="rounded"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                                    </iframe>
                                </div>
                            @else
                                <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 400px;">
                                    <div class="text-center text-white">
                                        <i class="fas fa-exclamation-triangle fa-4x mb-3"></i>
                                        <p>URL YouTube tidak valid</p>
                                        <small class="text-muted">{{ $multimedia->youtube_url }}</small>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 400px;">
                                <div class="text-center text-white">
                                    <i class="fab fa-youtube fa-4x mb-3"></i>
                                    <p>Video YouTube tidak tersedia</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Multimedia Description -->
                @if($multimedia->keterangan)
                <div class="card-body px-4 pb-4">
                    <div class="multimedia-content">
                        <h5 class="fw-bold mb-3">Deskripsi</h5>
                        <div class="text-muted">
                            {!! nl2br(e($multimedia->keterangan)) !!}
                        </div>
                    </div>

                    <!-- Multimedia Footer -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Konten agriedu untuk pembelajaran
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <button onclick="shareMultimedia()" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-share-alt me-1"></i>Bagikan
                            </button>

                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Comments Section -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-comments me-2"></i>Komentar
                        <span class="badge bg-primary ms-2">{{ $multimedia->comments->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
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

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @auth
                        <!-- Comment Form -->
                        <form action="{{ route('comments.store', $multimedia->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    @if(auth()->user()->foto)
                                        <img src="{{ asset('storage/users/' . auth()->user()->foto) }}"
                                             alt="{{ auth()->user()->name }}"
                                             class="rounded-circle"
                                             width="40" height="40">
                                    @else
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="form-group mb-3">
                                        <textarea name="content"
                                                  id="comment-content"
                                                  class="form-control"
                                                  rows="3"
                                                  placeholder="Tulis komentar Anda..."
                                                  required></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Gunakan bahasa yang sopan dan konstruktif
                                        </small>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-paper-plane me-1"></i>Kirim Komentar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a> untuk menambahkan komentar
                        </div>
                    @endauth

                    <!-- Comments List -->
                    <div id="comments-list">
                        @forelse($multimedia->comments()->orderBy('created_at', 'desc')->get() as $comment)
                            <div class="comment-item border-bottom pb-3 mb-3" data-comment-id="{{ $comment->id }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        @if($comment->user->foto)
                                            <img src="{{ asset('storage/users/' . $comment->user->foto) }}"
                                                 alt="{{ $comment->user->name }}"
                                                 class="rounded-circle"
                                                 width="40" height="40">
                                        @else
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $comment->user->name }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $comment->created_at->diffForHumans() }}
                                                    @if($comment->created_at != $comment->updated_at)
                                                        <span class="text-info">(diedit)</span>
                                                    @endif
                                                </small>
                                            </div>
                                            @auth
                                                @if(auth()->id() == $comment->user_id)
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="toggleEditForm({{ $comment->id }})">
                                                                    <i class="fas fa-edit me-2"></i>Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger"
                                                                            onclick="return confirm('Yakin ingin menghapus komentar ini?')">
                                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="comment-content">
                                            <p class="mb-0">{{ $comment->content }}</p>
                                        </div>

                                        <!-- Edit Form (Hidden by default) -->
                                        <div class="edit-form d-none mt-2" id="edit-form-{{ $comment->id }}">
                                            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mb-2">
                                                    <textarea name="content" class="form-control"
                                                              rows="3"
                                                              required>{{ $comment->content }}</textarea>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-save me-1"></i>Simpan
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $comment->id }})">
                                                        <i class="fas fa-times me-1"></i>Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4" id="no-comments">
                                <i class="fas fa-comments fa-3x mb-3 opacity-50"></i>
                                <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Multimedia Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Media
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-muted mb-1">Dipublikasi</h6>
                                <p class="mb-0 fw-bold">{{ $multimedia->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Jenis Media</h6>
                            <p class="mb-0 fw-bold">Video YouTube</p>
                        </div>
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
                        <a href="{{ route('frontend.modul.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-book me-2"></i>Modul Pembelajaran
                        </a>
                        <a href="{{ route('frontend.berita.index') }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-bullhorn me-2"></i>Berita Terbaru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.multimedia-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2c3e50;
    text-align: justify;
}

.multimedia-content p {
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

audio, video {
    outline: none;
}

@media print {
    .breadcrumb, .btn, .card-header, nav {
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
// Toggle edit form
function toggleEditForm(commentId) {
    const editForm = document.getElementById('edit-form-' + commentId);
    const commentContent = editForm.previousElementSibling;

    if (editForm.classList.contains('d-none')) {
        editForm.classList.remove('d-none');
        commentContent.classList.add('d-none');
    } else {
        editForm.classList.add('d-none');
        commentContent.classList.remove('d-none');
    }
}

// Utility functions for multimedia page
function shareMultimedia() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $multimedia->deskripsi }}',
            text: 'Lihat konten multimedia agriedu ini',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link multimedia telah disalin ke clipboard!');
        });
    }
}
</script>
@endsection
