<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Menampilkan seluruh pembayaran (Admin)
     */
    public function index()
    {
        $payments = Payment::with([
            'rental.user',
            'rental.car'
        ])->latest()->get();

        return view('payment.index', compact('payments'));
    }

    /**
     * Upload pembayaran (Customer)
     */
    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $rental = Rental::findOrFail($request->rental_id);

        $filename = null;

        if ($request->hasFile('bukti_pembayaran')) {

            $file = $request->file('bukti_pembayaran');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/payments'),
                $filename
            );
        }

        Payment::create([
            'rental_id' => $rental->id,
            'jumlah_bayar' => $rental->total_harga,
            'bukti_pembayaran' => $filename,
            'status' => 'menunggu'
        ]);

        return redirect()
            ->route('customer.rental.history')
            ->with('success', 'Bukti pembayaran berhasil diupload');
    }

    /**
     * Admin menyetujui pembayaran
     */
    public function approve($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'diterima'
        ]);

        return redirect()
            ->route('payment.index')
            ->with('success', 'Pembayaran berhasil disetujui');
    }

    /**
     * Admin menolak pembayaran
     */
    public function reject($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'ditolak'
        ]);

        $payment->rental->car->update([
            'status' => 'tersedia'
        ]);

        return redirect()
            ->route('payment.index')
            ->with('success', 'Pembayaran berhasil ditolak');
    }

    public function show($id)
    {
        $payment = Payment::with([
            'rental.user',
            'rental.car'
        ])->findOrFail($id);

        return view('payment.detail', compact('payment'));
    }
}
