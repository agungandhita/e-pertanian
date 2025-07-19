<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama'
    ];

    // Relasi dengan Artikel
    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategori_id', 'kategori_id');
    }

    // Relasi dengan Multimedia
    public function multimedia()
    {
        return $this->hasMany(Multimedia::class, 'kategori_id', 'kategori_id');
    }

    // Relasi dengan Modul
    public function moduls()
    {
        return $this->hasMany(Modul::class, 'kategori_id', 'kategori_id');
    }
}