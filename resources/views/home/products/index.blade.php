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
                                <select name="kategori" class="form-control">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->kategori_id }}" {{ request('kategori') == $kategori->kategori_id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="sort" class="form-control">
                                    <option value="">Urutkan</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                </select>
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
                                        <span class="h5 text-success mb-0">{{ $product->formatted_price }}</span>
                                        <small class="text-muted">Stok: {{ $product->stok }}</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm flex-fill">Detail</a>
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
                    alert('Produk berhasil ditambahkan ke keranjang!');
                    // Update cart count if exists
                    if($('#cart-count').length) {
                        $('#cart-count').text(response.cart_count);
                    }
                } else {
                    alert(response.message || 'Gagal menambahkan produk ke keranjang');
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                alert(response.message || 'Terjadi kesalahan');
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
