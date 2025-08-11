<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #28a745;
            padding-bottom: 20px;
        }
        
        .company-info h1 {
            color: #28a745;
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .company-info p {
            color: #666;
            margin: 2px 0;
        }
        
        .invoice-title {
            text-align: right;
        }
        
        .invoice-title h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .invoice-details div {
            flex: 1;
        }
        
        .invoice-details h3 {
            color: #28a745;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .status-shipped {
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        .status-delivered {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table th,
        .items-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .items-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .total-section {
            margin-left: auto;
            width: 300px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .total-row.final {
            border-bottom: 2px solid #28a745;
            font-weight: bold;
            font-size: 16px;
            color: #28a745;
        }
        
        .invoice-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        
        .shipping-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .shipping-info h4 {
            color: #28a745;
            margin-bottom: 10px;
        }
        
        @media print {
            body {
                font-size: 12px;
            }
            
            .invoice-container {
                padding: 0;
                max-width: none;
            }
            
            .no-print {
                display: none;
            }
        }
        
        .print-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .print-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <button class="print-button no-print" onclick="window.print()">🖨️ Cetak Invoice</button>
        
        <div class="invoice-header">
            <div class="company-info">
                <h1>Pertanian Store</h1>
                <p>Jl. Pertanian No. 123</p>
                <p>Jakarta, Indonesia 12345</p>
                <p>Telp: (021) 1234-5678</p>
                <p>Email: info@pertanianstore.com</p>
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p><strong>No: {{ $order->order_number }}</strong></p>
                <p>Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                @if($order->payment_date)
                    <p>Dibayar: {{ $order->payment_date->format('d M Y') }}</p>
                @endif
            </div>
        </div>
        
        <div class="invoice-details">
            <div>
                <h3>Tagihan Kepada:</h3>
                <p><strong>{{ $order->user->name }}</strong></p>
                <p>{{ $order->user->email }}</p>
                <p>{{ $order->phone }}</p>
            </div>
            <div>
                <h3>Status Pesanan:</h3>
                <span class="status-badge status-{{ $order->status }}">
                    {{ $order->status_label }}
                </span>
                <p style="margin-top: 10px;"><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>
            </div>
        </div>
        
        @if($order->shipping_address)
        <div class="shipping-info">
            <h4>📍 Alamat Pengiriman</h4>
            <p>{{ $order->shipping_address }}</p>
            @if($order->notes)
                <p><strong>Catatan:</strong> {{ $order->notes }}</p>
            @endif
        </div>
        @endif
        
        <table class="items-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->product->nama }}</strong>
                        @if($item->product->deskripsi)
                            <br><small style="color: #666;">{{ Str::limit($item->product->deskripsi, 50) }}</small>
                        @endif
                    </td>
                    <td>{{ $item->product->kategori->nama }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ $item->formatted_price }}</td>
                    <td class="text-right">{{ $item->formatted_subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>{{ $order->formatted_total_amount }}</span>
            </div>
            <div class="total-row">
                <span>Ongkos Kirim:</span>
                <span>Rp 0</span>
            </div>
            <div class="total-row final">
                <span>TOTAL:</span>
                <span>{{ $order->formatted_total_amount }}</span>
            </div>
        </div>
        
        <div class="invoice-footer">
            <p>Terima kasih atas kepercayaan Anda berbelanja di Pertanian Store!</p>
            <p>Invoice ini digenerate secara otomatis pada {{ now()->format('d M Y H:i') }}</p>
            <p>Untuk pertanyaan, hubungi customer service kami di info@pertanianstore.com</p>
        </div>
    </div>
    
    <script>
        // Auto print when opened in new tab
        if (window.location.search.includes('print=1')) {
            window.onload = function() {
                window.print();
            }
        }
    </script>
</body>
</html>