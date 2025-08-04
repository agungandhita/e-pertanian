<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'gambar'
    ];

    // Accessor untuk deskripsi (alias untuk isi)
    public function getDeskripsiAttribute()
    {
        return $this->isi;
    }

    // Accessor untuk mendapatkan URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/berita/' . $this->gambar);
        }
        return asset('images/default-news.jpg');
    }

    // Scope untuk berita terbaru
    public function scopeTerbaru($query, $limit = 5)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
}