@extends('home.layouts.main')

@section('title', 'Checkout')

@section('container')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Checkout</h2>
            
            <form action="{{ route('frontend.checkout.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Form Pengiriman -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Pengiriman</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="shipping_address">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('shipping_address') is-invalid @enderror" id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="notes">Catatan (Opsional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Catatan untuk penjual...">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Metode Pembayaran -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Metode Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method" id="dana" value="dana" {{ old('payment_method') == 'dana' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="dana">
                                            <strong>DANA</strong>
                                            <br><small class="text-muted">Transfer ke DANA: 0812-3456-7890 (a.n. Toko Pertanian)</small>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method" id="mandiri" value="mandiri" {{ old('payment_method') == 'mandiri' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="mandiri">
                                            <strong>Bank Mandiri</strong>
                                            <br><small class="text-muted">No. Rek: 1234567890 (a.n. Toko Pertanian)</small>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method" id="bri" value="bri" {{ old('payment_method') == 'bri' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="bri">
                                            <strong>Bank BRI</strong>
                                            <br><small class="text-muted">No. Rek: 0987654321 (a.n. Toko Pertanian)</small>
                                        </label>
                                    </div>
                                </div>
                                @error('payment_method')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ringkasan Pesanan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Ringkasan Pesanan</h5>
                            </div>
                            <div class="card-body">
                                @foreach($cartItems as $item)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">{{ $item->product->nama }}</h6>
                                            <small class="text-muted">{{ $item->quantity }} x {{ $item->product->formatted_price }}</small>
                                        </div>
                                        <span>{{ $item->formatted_subtotal }}</span>
                                    </div>
                                @endforeach
                                
                                <hr>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <strong>Total:</strong>
                                    <strong class="text-success">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                </div>
                                
                                <button type="submit" class="btn btn-success btn-block btn-lg">Buat Pesanan</button>
                                
                                <div class="mt-3">
                                    <a href="{{ route('frontend.cart.index') }}" class="btn btn-outline-secondary btn-block">Kembali ke Keranjang</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informasi Pengiriman -->
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="card-title">Informasi Pengiriman</h6>
                                <ul class="list-unstyled small text-muted mb-0">
                                    <li>• Pengiriman dalam 1-3 hari kerja</li>
                                    <li>• Gratis ongkir untuk pembelian di atas Rp 500.000</li>
                                    <li>• Barang akan dikirim setelah pembayaran dikonfirmasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection