@extends('home.layouts.main')

@section('title', 'Pembayaran - Order #' . $order->order_number)

@section('container')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Pesanan Berhasil Dibuat!</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Nomor Pesanan: {{ $order->order_number }}</h5>
                        <p class="mb-0">Silakan lakukan pembayaran sesuai dengan metode yang Anda pilih dan upload bukti pembayaran.</p>
                    </div>
                    
                    <!-- Upload Bukti Pembayaran -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Upload Bukti Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            @if($order->payment_proof)
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Bukti pembayaran sudah diupload. Menunggu verifikasi admin.
                                    <br><a href="{{ $order->payment_proof_url }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Lihat Bukti Pembayaran</a>
                                </div>
                                
                                <!-- Detail Pembayaran yang sudah dipilih -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Detail Pembayaran</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Metode Pembayaran:</strong>
                                                <p class="mb-0">{{ strtoupper($order->payment_method) }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Total Pembayaran:</strong>
                                                <h5 class="text-success mb-0">{{ $order->formatted_total_amount }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('frontend.orders.processPayment', $order->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    
                                    <!-- Pilih Metode Pembayaran -->
                                    <div class="form-group mb-3">
                                        <label class="form-label">Pilih Metode Pembayaran <span class="text-danger">*</span></label>
                                        @foreach($paymentMethods as $key => $method)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input @error('payment_method') is-invalid @enderror" type="radio" name="payment_method" id="{{ $key }}" value="{{ $key }}" required>
                                                <label class="form-check-label" for="{{ $key }}">
                                                    <strong>{{ $method['name'] }}</strong><br>
                                                    <small class="text-muted">{{ $method['account'] }} ({{ $method['account_name'] }})</small>
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('payment_method')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Total Pembayaran -->
                                    <div class="alert alert-info mb-3">
                                        <strong>Total Pembayaran: {{ $order->formatted_total_amount }}</strong>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="payment_proof">Pilih File Bukti Pembayaran <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" id="payment_proof" name="payment_proof" accept="image/*" required>
                                        <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                                        @error('payment_proof')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Detail Pesanan -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Detail Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->product->nama }}</td>
                                                <td>{{ $item->formatted_price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->formatted_subtotal }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total</th>
                                            <th>{{ $order->formatted_total_amount }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informasi Pengiriman -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Alamat:</strong><br>{{ $order->shipping_address }}</p>
                            <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                            @if($order->notes)
                                <p><strong>Catatan:</strong> {{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('frontend.orders.index') }}" class="btn btn-outline-primary">Lihat Semua Pesanan</a>
                        <a href="{{ route('frontend.products.index') }}" class="btn btn-primary">Lanjut Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Preview image before upload
    $('#payment_proof').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Remove existing preview
                $('.image-preview').remove();
                
                // Add new preview
                var preview = '<div class="image-preview mt-2"><img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;"></div>';
                $('#payment_proof').parent().append(preview);
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush
@endsection