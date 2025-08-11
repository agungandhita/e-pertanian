<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'status',
        'satuan'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    // Relasi dengan Kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // Relasi dengan Cart
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi dengan OrderItem
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor untuk mendapatkan URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/products/' . $this->gambar);
        }
        return asset('images/default-product.jpg');
    }

    // Accessor untuk format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Accessor untuk format harga per satuan
    public function getFormattedPricePerUnitAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.') . '/' . $this->satuan;
    }

    // Scope untuk produk aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk produk tersedia (stok > 0)
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }

    // Method untuk cek apakah produk tersedia
    public function isAvailable($quantity = 1)
    {
        return $this->status === 'aktif' && $this->stok >= $quantity;
    }

    // Method untuk mengurangi stok
    public function reduceStock($quantity)
    {
        if ($this->stok >= $quantity) {
            $this->decrement('stok', $quantity);
            return true;
        }
        return false;
    }
}