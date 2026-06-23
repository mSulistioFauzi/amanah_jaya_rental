<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'nama_mobil',
        'merk',
        'tahun',
        'plat_nomor',
        'harga_sewa',
        'gambar',
        'deskripsi',
        'status'
    ];

    // Relasi ke rental
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
