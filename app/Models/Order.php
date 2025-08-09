<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'total_amount',
        'status',
        'payment_method',
        'payment_proof',
        'payment_date',
        'shipping_address',
        'phone',
        'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan OrderItem
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor untuk format total amount
    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    // Accessor untuk URL bukti pembayaran
    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return asset('storage/payment_proofs/' . $this->payment_proof);
        }
        return null;
    }

    // Method untuk generate order number
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', today())->latest()->first();
        
        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->order_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return $prefix . $date . $newNumber;
    }

    // Method untuk mendapatkan status badge class
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'badge-warning',
            'paid' => 'badge-info',
            'processing' => 'badge-primary',
            'shipped' => 'badge-secondary',
            'delivered' => 'badge-success',
            'cancelled' => 'badge-danger',
            default => 'badge-light'
        };
    }

    // Method untuk mendapatkan status label
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown'
        };
    }
}