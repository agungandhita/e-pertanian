@extends('home.layouts.main')

@section('title', 'Keranjang Belanja')

@section('container')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Keranjang Belanja</h2>
            
            @if($cartItems->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr data-cart-id="{{ $item->id }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->product->gambar_url }}" alt="{{ $item->product->nama }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product->nama }}</h6>
                                                        <small class="text-muted">{{ $item->product->kategori->nama }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $item->product->formatted_price }}</td>
                                            <td class="align-middle">
                                                <div class="input-group" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm decrease-qty" data-cart-id="{{ $item->id }}">-</button>
                                                    </div>
                                                    <input type="number" class="form-control form-control-sm text-center quantity-input" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stok }}" data-cart-id="{{ $item->id }}">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm increase-qty" data-cart-id="{{ $item->id }}">+</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle subtotal">{{ $item->formatted_subtotal }}</td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-danger btn-sm remove-item" data-cart-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-danger" id="clear-cart">Kosongkan Keranjang</button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Lanjut Belanja</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4>Total: <span id="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span></h4>
                                <a href="{{ route('frontend.checkout.index') }}" class="btn btn-success btn-lg">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <div class="card">
                        <div class="card-body py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h4>Keranjang Belanja Kosong</h4>
                            <p class="text-muted">Anda belum menambahkan produk apapun ke keranjang.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Update quantity
    function updateQuantity(cartId, quantity) {
        $.ajax({
            url: '{{ route("frontend.cart.update", ":cart_id") }}'.replace(':cart_id', cartId),
            method: 'POST',
            data: {
                cart_id: cartId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // Update subtotal
                    $('tr[data-cart-id="' + cartId + '"] .subtotal').text(response.formatted_subtotal);
                    // Update total
                    $('#total-amount').text('Rp ' + response.formatted_total);
                    // Update cart count
                    if($('#cart-count').length) {
                        $('#cart-count').text(response.cart_count);
                    }
                } else {
                    alert(response.message || 'Gagal memperbarui keranjang');
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                alert(response.message || 'Terjadi kesalahan');
            }
        });
    }
    
    // Increase quantity
    $('.increase-qty').click(function() {
        var cartId = $(this).data('cart-id');
        var input = $('input[data-cart-id="' + cartId + '"]');
        var currentQty = parseInt(input.val());
        var maxQty = parseInt(input.attr('max'));
        
        if(currentQty < maxQty) {
            var newQty = currentQty + 1;
            input.val(newQty);
            updateQuantity(cartId, newQty);
        }
    });
    
    // Decrease quantity
    $('.decrease-qty').click(function() {
        var cartId = $(this).data('cart-id');
        var input = $('input[data-cart-id="' + cartId + '"]');
        var currentQty = parseInt(input.val());
        
        if(currentQty > 1) {
            var newQty = currentQty - 1;
            input.val(newQty);
            updateQuantity(cartId, newQty);
        }
    });
    
    // Manual quantity change
    $('.quantity-input').change(function() {
        var cartId = $(this).data('cart-id');
        var quantity = parseInt($(this).val());
        var maxQty = parseInt($(this).attr('max'));
        
        if(quantity < 1) {
            quantity = 1;
            $(this).val(quantity);
        } else if(quantity > maxQty) {
            quantity = maxQty;
            $(this).val(quantity);
        }
        
        updateQuantity(cartId, quantity);
    });
    
    // Remove item
    $('.remove-item').click(function() {
        if(confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
            var cartId = $(this).data('cart-id');
            var row = $('tr[data-cart-id="' + cartId + '"]');
            
            $.ajax({
                url: '{{ route("frontend.cart.destroy", ":cart_id") }}'.replace(':cart_id', cartId),
                method: 'POST',
                data: {
                    cart_id: cartId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        row.remove();
                        $('#total-amount').text('Rp ' + response.formatted_total);
                        
                        // Update cart count
                        if($('#cart-count').length) {
                            $('#cart-count').text(response.cart_count);
                        }
                        
                        // Reload page if cart is empty
                        if(response.cart_count == 0) {
                            location.reload();
                        }
                    } else {
                        alert(response.message || 'Gagal menghapus item');
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    alert(response.message || 'Terjadi kesalahan');
                }
            });
        }
    });
    
    // Clear cart
    $('#clear-cart').click(function() {
        if(confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
            $.ajax({
                url: '{{ route("frontend.cart.clear") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal mengosongkan keranjang');
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    alert(response.message || 'Terjadi kesalahan');
                }
            });
        }
    });
});
</script>
@endpush
@endsection