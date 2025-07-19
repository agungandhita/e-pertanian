<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia';

    protected $fillable = [
        'kategori_id',
        'deskripsi',
        'jenis_media',
        'file_path',
        'youtube_url'
    ];

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // Accessor untuk mendapatkan URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/multimedia/' . $this->file_path);
    }

    // Scope untuk filter berdasarkan jenis media
    public function scopeByJenisMedia($query, $jenis)
    {
        return $query->where('jenis_media', $jenis);
    }
}