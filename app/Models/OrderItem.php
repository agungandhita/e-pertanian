<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relasi dengan Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi dengan Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor untuk format price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Accessor untuk format subtotal
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    // Boot method untuk auto calculate subtotal
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($orderItem) {
            $orderItem->subtotal = $orderItem->quantity * $orderItem->price;
        });
        
        static::updating(function ($orderItem) {
            $orderItem->subtotal = $orderItem->quantity * $orderItem->price;
        });
    }
}