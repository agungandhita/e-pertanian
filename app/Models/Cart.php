<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor untuk subtotal (jika tidak ada di database, hitung dari product harga)
    public function getSubtotalAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return $this->quantity * ($this->price ?? $this->product->harga);
    }

    // Accessor untuk format subtotal
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    // Method untuk menambah quantity
    public function increaseQuantity($amount = 1)
    {
        $this->increment('quantity', $amount);
        $this->subtotal = $this->quantity * $this->price;
        $this->save();
    }

    // Method untuk mengurangi quantity
    public function decreaseQuantity($amount = 1)
    {
        if ($this->quantity > $amount) {
            $this->decrement('quantity', $amount);
            $this->subtotal = $this->quantity * $this->price;
            $this->save();
        } else {
            $this->delete();
        }
    }

    // Boot method untuk auto calculate price dan subtotal
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($cart) {
            if (!$cart->price) {
                $cart->price = $cart->product->harga;
            }
            $cart->subtotal = $cart->quantity * $cart->price;
        });
        
        static::updating(function ($cart) {
            if (!$cart->price) {
                $cart->price = $cart->product->harga;
            }
            $cart->subtotal = $cart->quantity * $cart->price;
        });
    }
}