<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    /**
     * Menampilkan seluruh data rental
     */
    public function index()
    {
        $rentals = Rental::with(['user', 'car'])
            ->latest()
            ->get();

        return view('rental.index', compact('rentals'));
    }

    /**
     * Detail rental
     */
    public function show($id)
    {
        $rental = Rental::with([
            'user',
            'car',
            'payments'
        ])->findOrFail($id);

        return view('rental.detail', compact('rental'));
    }

    public function create($id)
    {
        $car = Car::findOrFail($id);

        return view('customer.rental.create', compact('car'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa'
        ]);

        $car = Car::findOrFail($request->car_id);

        $lamaSewa = \Carbon\Carbon::parse(
            $request->tanggal_sewa
        )->diffInDays(
            \Carbon\Carbon::parse($request->tanggal_kembali)
        );

        $totalHarga = $lamaSewa * $car->harga_sewa;

        Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_sewa' => $lamaSewa,
            'total_harga' => $totalHarga,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('customer.rental.history')
            ->with('success', 'Pengajuan rental berhasil dibuat');
    }

    public function history()
    {
        $rentals = Rental::with([
            'car',
            'payments'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        return view(
            'customer.rental.history',
            compact('rentals')
        );
    }
    /**
     * Approve rental
     */
    public function approve($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'status' => 'disetujui'
        ]);

        $rental->car->update([
            'status' => 'disewa'
        ]);

        return redirect()
            ->route('rental.index')
            ->with('success', 'Rental berhasil disetujui');
    }

    /**
     * Reject rental
     */
    public function reject($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'status' => 'ditolak'
        ]);

        $rental->car->update([
            'status' => 'tersedia'
        ]);

        return redirect()
            ->route('rental.index')
            ->with('success', 'Rental berhasil ditolak');
    }
}
