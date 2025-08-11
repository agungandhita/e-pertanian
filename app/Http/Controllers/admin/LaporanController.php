<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPendapatanExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default periode: bulan ini
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        // Query pesanan yang sudah selesai dalam periode tertentu
        $ordersQuery = Order::with(['user', 'orderItems.product'])
            ->whereIn('status', ['delivered']) // status selesai di sistem ini adalah 'delivered'
            ->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        
        $orders = $ordersQuery->orderBy('updated_at', 'desc')->get();
        
        // Hitung statistik
        $totalPendapatan = $orders->sum('total_amount');
        $totalPesanan = $orders->count();
        $rataRataPendapatan = $totalPesanan > 0 ? $totalPendapatan / $totalPesanan : 0;
        
        // Pendapatan per hari
        $pendapatanPerHari = $orders->groupBy(function($item) {
            return Carbon::parse($item->updated_at)->format('Y-m-d');
        })->map(function($group) {
            return $group->sum('total_amount');
        });
        
        // Pendapatan per produk (dari order items)
        $pendapatanPerProduk = collect();
        foreach ($orders as $order) {
            foreach ($order->orderItems as $item) {
                $productName = $item->product->nama ?? 'Produk Tidak Ditemukan';
                if (!$pendapatanPerProduk->has($productName)) {
                    $pendapatanPerProduk->put($productName, [
                        'total' => 0,
                        'count' => 0
                    ]);
                }
                $currentData = $pendapatanPerProduk->get($productName);
                $currentData['total'] += $item->subtotal;
                $currentData['count'] += $item->quantity;
                $pendapatanPerProduk->put($productName, $currentData);
            }
        }
        
        return view('admin.laporan.index', compact(
            'orders',
            'totalPendapatan',
            'totalPesanan',
            'rataRataPendapatan',
            'pendapatanPerHari',
            'pendapatanPerProduk',
            'startDate',
            'endDate'
        ));
    }
    
    public function export(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        $fileName = 'laporan-pendapatan-' . $startDate . '-to-' . $endDate . '.xlsx';
        
        return Excel::download(new LaporanPendapatanExport($startDate, $endDate), $fileName);
    }
}