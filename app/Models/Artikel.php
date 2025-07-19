<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'kategori_id'
    ];

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // Accessor untuk mendapatkan URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/artikel/' . $this->gambar);
        }
        return asset('images/default-article.jpg');
    }
}