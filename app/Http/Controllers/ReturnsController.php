<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\ReturnCar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    /**
     * Menampilkan data pengembalian
     */
    public function index()
    {
        $returns = ReturnCar::with([
            'rental.user',
            'rental.car'
        ])->latest()->get();

        $rentals = Rental::with([
            'user',
            'car'
        ])
        ->where('status', 'approved')
        ->doesntHave('return')
        ->get();

        return view('return.index', compact(
            'returns',
            'rentals'
        ));
    }

    /**
     * Simpan data pengembalian
     */
    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'tanggal_pengembalian' => 'required|date',
            'keterangan' => 'nullable'
        ]);

        $rental = Rental::findOrFail($request->rental_id);

        $tanggalKembali = Carbon::parse($rental->tanggal_kembali);
        $tanggalPengembalian = Carbon::parse($request->tanggal_pengembalian);

        $terlambatHari = 0;
        $denda = 0;

        if ($tanggalPengembalian->gt($tanggalKembali)) {

            $terlambatHari = $tanggalKembali->diffInDays(
                $tanggalPengembalian
            );

            // Denda Rp100.000 per hari
            $denda = $terlambatHari * 100000;
        }

        ReturnCar::create([
            'rental_id' => $rental->id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'terlambat_hari' => $terlambatHari,
            'denda' => $denda,
            'keterangan' => $request->keterangan
        ]);

        $rental->update([
            'status' => 'returned'
        ]);

        $rental->car->update([
            'status' => 'tersedia'
        ]);

        return redirect()
            ->route('return.index')
            ->with(
                'success',
                'Data pengembalian berhasil disimpan'
            );
    }
}
