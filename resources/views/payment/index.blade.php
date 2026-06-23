@extends('layouts.template')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">
        Data Pembayaran
    </h2>

    <div class="row">

        @forelse($payments as $payment)

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h5 class="fw-bold">
                        {{ $payment->rental->user->name }}
                    </h5>

                    <p class="text-muted">
                        {{ $payment->rental->car->nama_mobil }}
                    </p>

                    <hr>

                    <h4 class="text-success">
                        Rp {{ number_format($payment->jumlah_bayar,0,',','.') }}
                    </h4>

                    <span class="badge bg-primary">
                        {{ ucfirst($payment->status) }}
                    </span>

                </div>

            </div>

        </div>

        @empty

        <div class="alert alert-info">
            Belum ada pembayaran.
        </div>

        @endforelse

    </div>

</div>

@endsection
