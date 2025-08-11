@extends('home.layouts.main')

@section('title', 'Produk Pertanian')

@section('container')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Produk Pertanian</h2>

            <!-- Filter dan Pencarian -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('frontend.products.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="kategori_id" class="form-control">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="sort_by" class="form-control">
                                    <option value="">Urutkan</option>
                                    <option value="nama" {{ request('sort_by') == 'nama' ? 'selected' : '' }}>Nama</option>
                                    <option value="harga" {{ request('sort_by') == 'harga' ? 'selected' : '' }}>Harga</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                                </select>
                                <input type="hidden" name="sort_order" value="{{ request('sort_order', 'asc') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ $product->gambar_url }}" class="card-img-top" alt="{{ $product->nama }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->nama }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($product->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <span class="h5 text-success mb-0">{{ $product->formatted_price_per_unit }}</span>
                                            <small class="text-muted d-block">{{ $product->formatted_price }}</small>
                                        </div>
                                        <small class="text-muted">Stok: {{ $product->stok }} {{ $product->satuan }}</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('frontend.products.show', $product->id) }}" class="btn btn-outline-primary btn-sm flex-fill">Detail</a>
                                        @if($product->stok > 0)
                                            <button class="btn btn-success btn-sm flex-fill add-to-cart" data-product-id="{{ $product->id }}">Tambah ke Keranjang</button>
                                        @else
                                            <button class="btn btn-secondary btn-sm flex-fill" disabled>Stok Habis</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h5>Tidak ada produk ditemukan</h5>
                            <p>Silakan coba dengan kata kunci atau filter yang berbeda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('.add-to-cart').click(function() {
        var productId = $(this).data('product-id');
        var button = $(this);

        button.prop('disabled', true).text('Menambahkan...');

        $.ajax({
            url: '{{ route("frontend.cart.add") }}',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: 1,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    alert('✅ Berhasil!\n\nProduk telah ditambahkan ke keranjang belanja Anda.\n\nAnda dapat melanjutkan berbelanja atau langsung checkout.');
                    // Update cart count if exists
                    if($('#cart-count').length) {
                        $('#cart-count').text(response.cart_count);
                    }
                } else {
                    alert('❌ Gagal Menambahkan!\n\n' + (response.message || 'Terjadi kesalahan saat menambahkan produk ke keranjang.\n\nSilakan coba lagi atau hubungi customer service.'));
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                alert('❌ Kesalahan Sistem!\n\n' + (response.message || 'Terjadi kesalahan pada server.\n\nSilakan refresh halaman dan coba lagi.\nJika masalah berlanjut, hubungi customer service.'));
            },
            complete: function() {
                button.prop('disabled', false).text('Tambah ke Keranjang');
            }
        });
    });
});
</script>
@endpush
@endsection
