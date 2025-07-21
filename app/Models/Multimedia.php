<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Comment;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia';

    protected $fillable = [
        'kategori_id',
        'deskripsi',
        'jenis_media',
        'file_path',
        'youtube_url',
        'keterangan',
        'gambar'
    ];

    // Relasi dengan Kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    // Relasi dengan Comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Accessor untuk total komentar
    public function getTotalCommentsAttribute()
    {
        return $this->comments()->count();
    }


    // Accessor untuk mendapatkan URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/multimedia/' . $this->file_path);
    }

    // Accessor untuk mendapatkan URL gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/multimedia/images/' . $this->gambar);
        }
        return null;
    }


}
