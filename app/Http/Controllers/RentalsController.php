<?php

namespace App\Http\Controllers;

use App\Models\Rental;
// use Illuminate\Http\Request;

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

    /**
     * Approve rental
     */
    public function approve($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'status' => 'approved'
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
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('rental.index')
            ->with('success', 'Rental berhasil ditolak');
    }
}
