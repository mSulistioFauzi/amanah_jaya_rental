<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'lama_sewa',
        'total_harga',
        'status'
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_kembali' => 'date',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function return()
    {
        return $this->hasOne(ReturnCar::class, 'rental_id');
    }
}
