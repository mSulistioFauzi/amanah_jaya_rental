<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnCar extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'rental_id',
        'tanggal_pengembalian',
        'terlambat_hari',
        'denda',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'date',
        'denda' => 'decimal:2',
    ];

    // Relasi ke rental
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
