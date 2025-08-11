<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user's orders
     */
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
            ->with('orderItems.product');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return view('home.orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.product.kategori');

        return view('home.orders.show', compact('order'));
    }

    /**
     * Cancel order (only for pending status)
     */
    public function cancel(Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow cancellation for pending orders
        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak dapat dibatalkan!'
            ]);
        }

        $order->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibatalkan!'
        ]);
    }

    /**
     * Confirm order delivery
     */
    public function confirmDelivery(Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow confirmation for shipped orders
        if ($order->status !== 'shipped') {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan belum dikirim!'
            ]);
        }

        $order->update(['status' => 'delivered']);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Pesanan telah dikonfirmasi diterima.'
        ]);
    }

    /**
     * Download invoice
     */
    public function invoice(Order $order)
    {
        // Check if order belongs to current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.product', 'user');

        return view('home.orders.invoice', compact('order'));
    }
}
