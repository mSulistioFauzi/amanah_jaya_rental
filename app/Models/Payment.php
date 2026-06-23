<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'rental_id',
        'jumlah_bayar',
        'bukti_pembayaran',
        'status'
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
    ];

    // Relasi ke rental
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
