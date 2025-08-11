@extends('admin.layouts.main')

@section('title', 'Buat Pesanan Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Buat Pesanan Baru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Kolom Kiri - Info Pembeli -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-user me-2"></i>Informasi Pembeli
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Pilih Pembeli <span class="text-danger">*</span></label>
                                            <select class="form-select" id="user_id" name="user_id" required>
                                                <option value="">-- Pilih Pembeli --</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="phone" name="phone" 
                                                   value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="shipping_address" class="form-label">Alamat Pengiriman</label>
                                            <textarea class="form-control" id="shipping_address" name="shipping_address" 
                                                      rows="3" placeholder="Masukkan alamat lengkap">{{ old('shipping_address') }}</textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Catatan</label>
                                            <textarea class="form-control" id="notes" name="notes" 
                                                      rows="2" placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Info Pembayaran -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-credit-card me-2"></i>Informasi Pembayaran
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="payment_method" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                            <select class="form-select" id="payment_method" name="payment_method" required>
                                                <option value="">-- Pilih Metode Pembayaran --</option>
                                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                                <option value="dana" {{ old('payment_method') == 'dana' ? 'selected' : '' }}>DANA</option>
                                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status Pesanan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Kolom Kanan - Produk -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-shopping-bag me-2"></i>Daftar Produk
                                        </h5>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="addProduct()">
                                            <i class="fas fa-plus me-1"></i>Tambah Produk
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="productList">
                                            <!-- Product items will be added here -->
                                        </div>
                                        
                                        <div class="border-top pt-3 mt-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong>Total Pesanan:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <strong class="text-success fs-5" id="totalAmount">Rp 0</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-2"></i>Simpan Pesanan
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

<!-- Template untuk item produk -->
<template id="productItemTemplate">
    <div class="product-item border rounded p-3 mb-3">
        <div class="row align-items-center">
            <div class="col-md-5">
                <label class="form-label">Produk</label>
                <select class="form-select product-select" name="products[INDEX][product_id]" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" 
                                data-price="{{ $product->price }}" 
                                data-stock="{{ $product->stock }}" 
                                data-unit="{{ $product->unit }}">
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}/{{ $product->unit }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Jumlah</label>
                <input type="number" class="form-control quantity-input" 
                       name="products[INDEX][quantity]" 
                       min="1" value="1" required>
                <small class="text-muted stock-info"></small>
            </div>
            <div class="col-md-3">
                <label class="form-label">Subtotal</label>
                <div class="form-control-plaintext fw-bold subtotal">Rp 0</div>
            </div>
            <div class="col-md-1">
                <label class="form-label">&nbsp;</label>
                <button type="button" class="btn btn-danger btn-sm d-block" onclick="removeProduct(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</template>
@endsection

@push('scripts')
<script>
let productIndex = 0;

function addProduct() {
    const template = document.getElementById('productItemTemplate');
    const clone = template.content.cloneNode(true);
    
    // Replace INDEX with actual index
    const html = clone.querySelector('.product-item').outerHTML.replace(/INDEX/g, productIndex);
    
    const productList = document.getElementById('productList');
    productList.insertAdjacentHTML('beforeend', html);
    
    // Add event listeners to the new product item
    const newItem = productList.lastElementChild;
    const productSelect = newItem.querySelector('.product-select');
    const quantityInput = newItem.querySelector('.quantity-input');
    
    productSelect.addEventListener('change', updateSubtotal);
    quantityInput.addEventListener('input', updateSubtotal);
    
    productIndex++;
    
    // If this is the first product, trigger calculation
    if (productIndex === 1) {
        calculateTotal();
    }
}

function removeProduct(button) {
    button.closest('.product-item').remove();
    calculateTotal();
}

function updateSubtotal(event) {
    const productItem = event.target.closest('.product-item');
    const productSelect = productItem.querySelector('.product-select');
    const quantityInput = productItem.querySelector('.quantity-input');
    const subtotalElement = productItem.querySelector('.subtotal');
    const stockInfo = productItem.querySelector('.stock-info');
    
    const selectedOption = productSelect.selectedOptions[0];
    
    if (selectedOption && selectedOption.value) {
        const price = parseFloat(selectedOption.dataset.price);
        const stock = parseInt(selectedOption.dataset.stock);
        const unit = selectedOption.dataset.unit;
        const quantity = parseInt(quantityInput.value) || 0;
        
        // Update stock info
        stockInfo.textContent = `Stok: ${stock} ${unit}`;
        
        // Validate quantity against stock
        if (quantity > stock) {
            quantityInput.value = stock;
            alert(`⚠️ Peringatan Stok!\n\nJumlah yang Anda masukkan melebihi stok yang tersedia.\n\nStok tersedia: ${stock} ${unit}\nJumlah akan disesuaikan ke maksimal stok yang ada.`);
        }
        
        // Calculate subtotal
        const subtotal = price * (parseInt(quantityInput.value) || 0);
        subtotalElement.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    } else {
        subtotalElement.textContent = 'Rp 0';
        stockInfo.textContent = '';
    }
    
    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    
    document.querySelectorAll('.product-item').forEach(item => {
        const productSelect = item.querySelector('.product-select');
        const quantityInput = item.querySelector('.quantity-input');
        
        const selectedOption = productSelect.selectedOptions[0];
        if (selectedOption && selectedOption.value) {
            const price = parseFloat(selectedOption.dataset.price);
            const quantity = parseInt(quantityInput.value) || 0;
            total += price * quantity;
        }
    });
    
    document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Form validation
document.getElementById('orderForm').addEventListener('submit', function(e) {
    const productItems = document.querySelectorAll('.product-item');
    
    if (productItems.length === 0) {
        e.preventDefault();
        alert('❌ Pesanan Tidak Valid!\n\nAnda belum menambahkan produk apapun ke dalam pesanan.\n\nSilakan tambahkan minimal 1 produk untuk melanjutkan.');
        return;
    }
    
    // Validate each product item
    let isValid = true;
    productItems.forEach(item => {
        const productSelect = item.querySelector('.product-select');
        const quantityInput = item.querySelector('.quantity-input');
        
        if (!productSelect.value || !quantityInput.value || quantityInput.value < 1) {
            isValid = false;
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('❌ Data Pesanan Tidak Lengkap!\n\nMohon periksa kembali:\n• Pastikan semua produk telah dipilih\n• Pastikan jumlah produk sudah diisi dengan benar\n• Jumlah harus lebih dari 0\n\nSilakan lengkapi data sebelum menyimpan pesanan.');
    }
});

// Add first product item on page load
document.addEventListener('DOMContentLoaded', function() {
    addProduct();
});
</script>
@endpush