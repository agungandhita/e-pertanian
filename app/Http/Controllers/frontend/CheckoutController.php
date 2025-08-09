<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkout form
     */
    public function index()
    {
        $cartItems = Cart::with('product.kategori')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            Alert::warning('Peringatan', 'Keranjang belanja Anda kosong!');
            return redirect()->route('products.index');
        }

        // Check stock availability
        foreach ($cartItems as $item) {
            if (!$item->product->isAvailable($item->quantity)) {
                Alert::error('Error', "Stok produk {$item->product->nama} tidak mencukupi!");
                return redirect()->route('frontend.cart.index');
            }
        }

        $total = $cartItems->sum('subtotal');
        $user = Auth::user();

        return view('home.checkout.index', compact('cartItems', 'total', 'user'));
    }

    /**
     * Process checkout
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500'
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            Alert::warning('Peringatan', 'Keranjang belanja Anda kosong!');
            return redirect()->route('products.index');
        }

        // Check stock availability again
        foreach ($cartItems as $item) {
            if (!$item->product->isAvailable($item->quantity)) {
                Alert::error('Error', "Stok produk {$item->product->nama} tidak mencukupi!");
                return redirect()->route('frontend.cart.index');
            }
        }

        $total = $cartItems->sum('subtotal');

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price ?? $item->product->harga,
                    'subtotal' => $item->subtotal
                ]);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            Alert::success('Berhasil', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
            return redirect()->route('frontend.orders.payment', $order->id);

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Terjadi kesalahan saat memproses pesanan!');
            return back();
        }
    }

    /**
     * Show payment page
     */
    public function payment(Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow payment for pending orders
        if ($order->status !== 'pending') {
            Alert::info('Info', 'Pesanan ini sudah diproses!');
            return redirect()->route('frontend.orders.show', $order->id);
        }

        $order->load('orderItems.product');

        // Payment methods with account details
        $paymentMethods = [
            'dana' => [
                'name' => 'DANA',
                'account' => '081234567890',
                'account_name' => 'Toko Pertanian'
            ],
            'mandiri' => [
                'name' => 'Bank Mandiri',
                'account' => '1234567890',
                'account_name' => 'Toko Pertanian'
            ],
            'bri' => [
                'name' => 'Bank BRI',
                'account' => '0987654321',
                'account_name' => 'Toko Pertanian'
            ]
        ];

        return view('home.checkout.payment', compact('order', 'paymentMethods'));
    }

    /**
     * Process payment proof upload
     */
    public function processPayment(Request $request, Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow payment for pending orders
        if ($order->status !== 'pending') {
            Alert::info('Info', 'Pesanan ini sudah diproses!');
            return redirect()->route('frontend.orders.show', $order->id);
        }

        $request->validate([
            'payment_method' => 'required|in:dana,mandiri,bri',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'payment_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/payment_proofs', $filename);

            // Update order
            $order->update([
                'payment_method' => $request->payment_method,
                'payment_proof' => $filename,
                'payment_date' => now(),
                'status' => 'paid'
            ]);

            Alert::success('Berhasil', 'Bukti pembayaran berhasil diunggah! Pesanan Anda sedang diverifikasi.');
            return redirect()->route('frontend.orders.show', $order->id);
        }

        Alert::error('Error', 'Gagal mengunggah bukti pembayaran!');
        return back();
    }
}