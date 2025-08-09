<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with('user', 'orderItems.product');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->latest()->paginate(15);

        // Statistics
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'paid_orders' => Order::where('status', 'paid')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'shipped_orders' => Order::where('status', 'shipped')->count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->sum('total_amount')
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product.kategori');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,delivered,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Business logic for status transitions
        $allowedTransitions = [
            'pending' => ['paid', 'cancelled'],
            'paid' => ['processing', 'cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped' => ['delivered'],
            'delivered' => [], // Final status
            'cancelled' => [] // Final status
        ];

        if (!in_array($newStatus, $allowedTransitions[$oldStatus])) {
            Alert::error('Error', 'Perubahan status tidak diizinkan!');
            return back();
        }

        DB::beginTransaction();
        try {
            // If changing from processing to shipped, reduce product stock
            if ($oldStatus === 'processing' && $newStatus === 'shipped') {
                foreach ($order->orderItems as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        if (!$product->reduceStock($item->quantity)) {
                            throw new \Exception("Stok produk {$product->nama} tidak mencukupi!");
                        }
                    }
                }
            }

            // If cancelling order after processing, restore product stock
            if (in_array($oldStatus, ['processing', 'shipped']) && $newStatus === 'cancelled') {
                foreach ($order->orderItems as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->increment('stok', $item->quantity);
                    }
                }
            }

            $order->update(['status' => $newStatus]);

            DB::commit();
            Alert::success('Berhasil', 'Status pesanan berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', $e->getMessage());
        }

        return back();
    }

    /**
     * Verify payment proof
     */
    public function verifyPayment(Order $order)
    {
        if ($order->status !== 'paid') {
            Alert::error('Error', 'Pesanan belum dalam status dibayar!');
            return back();
        }

        $order->update(['status' => 'processing']);

        Alert::success('Berhasil', 'Pembayaran berhasil diverifikasi!');
        return back();
    }

    /**
     * Download order report
     */
    public function report(Request $request)
    {
        $query = Order::with('user', 'orderItems.product');

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();

        return view('admin.orders.report', compact('orders'));
    }
}