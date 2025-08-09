@extends('admin.layouts.main')

@section('title', 'Tambah Produk')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tambah Produk Baru</h3>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror"
                                            id="kategori_id" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
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

                                <!-- Harga -->
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                               id="harga" name="harga" value="{{ old('harga') }}" min="0" step="1000" required>
                                    </div>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Stok -->
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                           id="stok" name="stok" value="{{ old('stok') }}" min="0" required>
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Satuan -->
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('satuan') is-invalid @enderror"
                                            id="satuan" name="satuan" required>
                                        <option value="">Pilih Satuan</option>
                                        <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                        <option value="gram" {{ old('satuan') == 'gram' ? 'selected' : '' }}>Gram</option>
                                        <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                                        <option value="ml" {{ old('satuan') == 'ml' ? 'selected' : '' }}>Mililiter (ml)</option>
                                        <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                        <option value="pack" {{ old('satuan') == 'pack' ? 'selected' : '' }}>Pack</option>
                                        <option value="botol" {{ old('satuan') == 'botol' ? 'selected' : '' }}>Botol</option>
                                        <option value="karung" {{ old('satuan') == 'karung' ? 'selected' : '' }}>Karung</option>
                                    </select>
                                    @error('satuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <!-- Gambar Produk -->
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                           id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>

                                    <!-- Preview Image -->
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                              id="deskripsi" name="deskripsi" rows="6" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Jelaskan detail produk, manfaat, dan cara penggunaan.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
}

// Format harga input
document.getElementById('harga').addEventListener('input', function(e) {
    let value = e.target.value;
    // Remove non-numeric characters except for the decimal point
    value = value.replace(/[^\d]/g, '');
    e.target.value = value;
});
</script>
@endpush
