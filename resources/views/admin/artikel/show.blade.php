@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Detail Artikel</h4>
                    <div>
                        <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">Judul Artikel</h5>
                                <h3 class="mb-0">{{ $artikel->judul }}</h3>
                            </div>
                            
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">Deskripsi</h5>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($artikel->deskripsi)) !!}
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-muted mb-2">Tanggal Dibuat</h5>
                                    <p class="mb-0">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        {{ $artikel->created_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted mb-2">Terakhir Diperbarui</h5>
                                    <p class="mb-0">
                                        <i class="fas fa-clock text-success me-2"></i>
                                        {{ $artikel->updated_at->format('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <h5 class="text-muted mb-2">Gambar Artikel</h5>
                                @if($artikel->gambar)
                                    <div class="border rounded p-2">
                                        <img src="{{ $artikel->gambar_url }}" alt="{{ $artikel->judul }}" 
                                             class="img-fluid rounded" style="width: 100%; max-height: 300px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="border rounded p-5 text-center bg-light">
                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Tidak ada gambar</p>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('frontend.artikel.show', $artikel) }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-external-link-alt"></i> Lihat di Frontend
                                </a>
                                <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Artikel
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $artikel) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-trash"></i> Hapus Artikel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection