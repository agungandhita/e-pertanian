<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $table = 'moduls';

    protected $fillable = [
        'judul',
        'kategori_id',
        'deskripsi',
        'konten',
        'cover',
        'file_path'
    ];

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // Accessor untuk mendapatkan URL file PDF
    public function getFilePdfUrlAttribute()
    {
        return $this->file_path ? asset('storage/modul/files/' . $this->file_path) : null;
    }

    // Accessor untuk mendapatkan URL cover
    public function getCoverUrlAttribute()
    {
        return $this->cover ? asset('storage/modul/covers/' . $this->cover) : null;
    }
}
