<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class LaporanPendapatanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $orders;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        
        // Query pesanan yang sudah selesai dalam periode tertentu
        $this->orders = Order::with(['user', 'orderItems.product'])
            ->whereIn('status', ['delivered']) // status selesai di sistem ini adalah 'delivered'
            ->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->orders;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nomor Pesanan',
            'Tanggal Selesai',
            'Nama Pelanggan',
            'Email Pelanggan',
            'Total Pendapatan',
            'Metode Pembayaran',
            'Produk',
            'Alamat Pengiriman',
            'No. Telepon'
        ];
    }

    /**
     * @param mixed $order
     * @return array
     */
    public function map($order): array
    {
        static $no = 1;
        
        // Gabungkan semua produk dalam satu string
        $products = $order->orderItems->map(function($item) {
            return $item->product->nama . ' (' . $item->quantity . ' ' . ($item->product->satuan ?? 'pcs') . ')';
        })->implode(', ');
        
        return [
            $no++,
            $order->order_number,
            $order->updated_at->format('d/m/Y H:i'),
            $order->user->name ?? '-',
            $order->user->email ?? '-',
            'Rp ' . number_format($order->total_amount, 0, ',', '.'),
            $order->payment_method ? ucfirst($order->payment_method) : '-',
            $products,
            $order->shipping_address,
            $order->phone
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->orders->count() + 1;
        
        // Tambahkan informasi periode di atas header
        $sheet->insertNewRowBefore(1, 3);
        $sheet->setCellValue('A1', 'LAPORAN PENDAPATAN');
        $sheet->setCellValue('A2', 'Periode: ' . Carbon::parse($this->startDate)->format('d/m/Y') . ' - ' . Carbon::parse($this->endDate)->format('d/m/Y'));
        $sheet->setCellValue('A3', 'Total Pendapatan: Rp ' . number_format($this->orders->sum('total_amount'), 0, ',', '.'));
        
        // Merge cells untuk judul
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');
        $sheet->mergeCells('A3:J3');
        
        $lastRow += 3; // Karena kita menambah 3 baris
        
        return [
            // Style untuk judul
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            // Style untuk periode
            '2:3' => [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            // Style untuk header
            4 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ],
            // Style untuk data
            "A5:J{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            // Style untuk kolom nomor
            "A5:A{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            // Style untuk kolom total
            "F5:F{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT
                ]
            ]
        ];
    }
}