@extends('home.layouts.main')

@section('title', $product->nama)

@section('container')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->gambar_url }}" class="img-fluid rounded" alt="{{ $product->nama }}">
        </div>
        <div class="col-md-6">
            <div class="product-details">
                <h1 class="h2 mb-3">{{ $product->nama }}</h1>
                <p class="text-muted mb-2">Kategori: <span class="badge badge-secondary">{{ $product->kategori->nama }}</span></p>
                <h3 class="text-success mb-3">{{ $product->formatted_price_per_unit }}</h3>
                <p class="text-muted mb-3">Total: {{ $product->formatted_price }}</p>

                <div class="mb-3">
                    <strong>Deskripsi:</strong>
                    <p class="mt-2">{{ $product->deskripsi }}</p>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-6">
                            <strong>Stok:</strong> {{ $product->stok }} {{ $product->satuan }}
                        </div>
                        <div class="col-6">
                            <strong>Satuan:</strong> {{ $product->satuan }}
                        </div>
                    </div>
                </div>

                @if($product->stok > 0)
                    <div class="mb-4">
                        <form id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group">
                                <label for="quantity">Jumlah:</label>
                                <div class="input-group" style="max-width: 150px;">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-outline-secondary" id="decrease-qty">-</button>
                                    </div>
                                    <input type="number" class="form-control text-center" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stok }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="increase-qty">+</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg">Tambah ke Keranjang</button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <strong>Stok Habis!</strong> Produk ini sedang tidak tersedia.
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('frontend.products.index') }}" class="btn btn-outline-secondary mb-3">← Kembali ke Daftar Produk</a>
                </div>
            </div>
        </div>
    </div>

    @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3>Produk Terkait</h3>
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100">
                                <img src="{{ $relatedProduct->gambar_url }}" class="card-img-top" alt="{{ $relatedProduct->nama }}" style="height: 150px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ $relatedProduct->nama }}</h6>
                                    <p class="card-text text-success">{{ $relatedProduct->formatted_price_per_unit }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('frontend.products.show', $relatedProduct->id) }}" class="btn btn-outline-primary btn-sm btn-block">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Quantity controls
    $('#increase-qty').click(function() {
        var qty = parseInt($('#quantity').val());
        var max = parseInt($('#quantity').attr('max'));
        if(qty < max) {
            $('#quantity').val(qty + 1);
        }
    });

    $('#decrease-qty').click(function() {
        var qty = parseInt($('#quantity').val());
        if(qty > 1) {
            $('#quantity').val(qty - 1);
        }
    });

    // Add to cart
    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        var originalText = submitBtn.text();

        submitBtn.prop('disabled', true).text('Menambahkan...');

        $.ajax({
            url: '{{ route("frontend.cart.add") }}',
            method: 'POST',
            data: form.serialize(),
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
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });
});
</script>
@endpush
@endsection
