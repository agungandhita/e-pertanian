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

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $orders;
    protected $filters;

    public function __construct($orders, $filters = [])
    {
        $this->orders = $orders;
        $this->filters = $filters;
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
            'Tanggal Pesanan',
            'Nama Pelanggan',
            'Email Pelanggan',
            'Status',
            'Metode Pembayaran',
            'Total Pesanan',
            'Alamat Pengiriman',
            'No. Telepon',
            'Catatan'
        ];
    }

    /**
     * @param mixed $order
     * @return array
     */
    public function map($order): array
    {
        static $no = 1;
        
        return [
            $no++,
            $order->order_number,
            $order->created_at->format('d/m/Y H:i'),
            $order->user->name ?? '-',
            $order->user->email ?? '-',
            $order->status_label,
            $order->payment_method ? ucfirst($order->payment_method) : '-',
            'Rp ' . number_format($order->total_amount, 0, ',', '.'),
            $order->shipping_address,
            $order->phone,
            $order->notes ?? '-'
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->orders->count() + 1;
        
        return [
            // Style untuk header
            1 => [
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
            "A2:K{$lastRow}" => [
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
            "A2:A{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            // Style untuk kolom total
            "H2:H{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT
                ]
            ]
        ];
    }
}