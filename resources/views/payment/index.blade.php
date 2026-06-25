@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Data Pembayaran</h2>
                <p class="text-muted">Verifikasi pembayaran customer</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($payments as $payment)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">

                        @if ($payment->bukti_pembayaran)
                            <a href="{{ asset('uploads/payments/' . $payment->bukti_pembayaran) }}" target="_blank">
                                <img src="{{ asset('uploads/payments/' . $payment->bukti_pembayaran) }}" class="card-img-top"
                                    style="height:250px; object-fit:cover;" alt="Bukti Pembayaran">
                            </a>
                        @else
                            <img src="https://via.placeholder.com/500x300" class="card-img-top"
                                style="height:250px; object-fit:cover;" alt="Tidak Ada Bukti">
                        @endif

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">
                                    {{ $payment->rental->user->name }}
                                </h5>

                                @if ($payment->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($payment->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($payment->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </div>

                            <hr>

                            <p class="mb-1">
                                <strong>Mobil :</strong>
                                {{ $payment->rental->car->nama_mobil }}
                            </p>

                            <p class="mb-1">
                                <strong>Plat :</strong>
                                {{ $payment->rental->car->plat_nomor }}
                            </p>

                            <p class="mb-1">
                                <strong>Tanggal Sewa :</strong>
                                {{ \Carbon\Carbon::parse($payment->rental->tanggal_sewa)->format('d M Y') }}
                            </p>

                            <p class="mb-3">
                                <strong>Tanggal Kembali :</strong>
                                {{ \Carbon\Carbon::parse($payment->rental->tanggal_kembali)->format('d M Y') }}
                            </p>

                            <div class="bg-light rounded p-3 text-center">
                                <small class="text-muted">
                                    Jumlah Pembayaran
                                </small>

                                <h4 class="text-success fw-bold mb-0">
                                    Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0">
                            @if ($payment->status == 'menunggu')
                                <div class="d-grid gap-2">
                                    <form action="{{ route('payment.approve', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="ri-check-line"></i>
                                            Setujui Pembayaran
                                        </button>
                                    </form>

                                    <form action="{{ route('payment.reject', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="ri-close-line"></i>
                                            Tolak Pembayaran
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="alert alert-secondary text-center mb-0">
                                    Pembayaran sudah diverifikasi
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada pembayaran dari customer.
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
