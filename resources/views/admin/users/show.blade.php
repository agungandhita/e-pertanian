@extends('admin.layouts.main')

@section('title', 'Detail User - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-0 text-gray-800">Detail User</h2>
        <p class="text-muted mb-0">Informasi lengkap user</p>
    </div>
    <div>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}"
                                 class="img-fluid rounded-circle mb-3"
                                 alt="{{ $user->name }}"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>
                        @endif
                        <h4>{{ $user->name }}</h4>
                        <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-success' }}">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-primary mb-3">Informasi Personal</h5>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Nama Lengkap:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Role:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-success' }}">{{ ucfirst($user->role) }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Bergabung:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $user->created_at->format('d M Y H:i') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Terakhir Update:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $user->updated_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Akun -->
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <h5 class="mb-0">Informasi Akun</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <small class="text-muted">Status Akun:</small><br>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Role:</small><br>
                            <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-success' }}">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <small class="text-muted">Email Verified:</small><br>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">Verified</span><br>
                                <small class="text-muted">{{ $user->email_verified_at->format('d M Y H:i') }}</small>
                            @else
                                <span class="badge bg-warning">Not Verified</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a>
                    <button type="button" class="btn btn-danger" onclick="deleteUser({{ $user->id }})">
                        <i class="fas fa-trash me-2"></i>Hapus User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>Daftar User
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-3">
            <div class="card-header">
                <h5 class="mb-0">Informasi Tambahan</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Catatan:</strong>
                    <ul class="mb-0 mt-2">
                        <li>User dengan role admin memiliki akses penuh ke sistem</li>
                        <li>User dengan role user memiliki akses terbatas</li>
                        <li>Perubahan role akan berlaku setelah user login ulang</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Delete (Hidden) -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function deleteUser(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini? Semua data terkait akan ikut terhapus.')) {
        const form = document.getElementById('delete-form');
        form.action = `/admin/users/${userId}`;
        form.submit();
    }
}
</script>
@endpush
