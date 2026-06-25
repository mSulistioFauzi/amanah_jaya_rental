@extends('layouts.template')

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Detail Rental</h2>
                <p class="text-muted">Informasi lengkap penyewaan mobil</p>
            </div>

            <a href="{{ route('rental.index') }}" class="btn btn-secondary">
                <i class="ri-arrow-left-line"></i>
                Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Data Customer</h5>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="180">Nama</th>
                                <td>{{ $rental->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $rental->user->email }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>{{ $rental->user->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $rental->user->address ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Data Mobil</h5>
                    </div>

                    <div class="card-body text-center">
                        @if ($rental->car->gambar)
                            <img src="{{ asset('uploads/cars/' . $rental->car->gambar) }}" class="img-fluid rounded mb-3"
                                style="max-height:250px">
                        @endif

                        <h4 class="fw-bold">{{ $rental->car->nama_mobil }}</h4>
                        <p class="text-muted">{{ $rental->car->merk }}</p>

                        <table class="table">
                            <tr>
                                <th>Tahun</th>
                                <td>{{ $rental->car->tahun }}</td>
                            </tr>
                            <tr>
                                <th>Plat Nomor</th>
                                <td>{{ $rental->car->plat_nomor }}</td>
                            </tr>
                            <tr>
                                <th>Harga / Hari</th>
                                <td>
                                    Rp {{ number_format($rental->car->harga_sewa, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Rental --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Data Rental</h5>
            </div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="220">Tanggal Sewa</th>
                        <td>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</td>
                    </tr>

                    <tr>
                        <th>Lama Sewa</th>
                        <td>{{ $rental->lama_sewa }} Hari</td>
                    </tr>

                    <tr>
                        <th>Total Harga</th>
                        <td>
                            <strong class="text-primary">
                                Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <th>Status Rental</th>
                        <td>
                            @if ($rental->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($rental->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($rental->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @elseif($rental->status == 'returned')
                                <span class="badge bg-primary">Returned</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Data Pembayaran --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Data Pembayaran</h5>
            </div>

            <div class="card-body">
                @if ($rental->payments->count())
                    @foreach ($rental->payments as $payment)
                        <div class="border rounded p-3 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <strong>Jumlah Bayar:</strong><br>
                                        Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}
                                    </p>

                                    <p>
                                        <strong>Status:</strong><br>

                                        @if ($payment->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($payment->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($payment->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 text-center">
                                    @if ($payment->bukti_pembayaran)
                                        <img src="{{ asset('uploads/payments/' . $payment->bukti_pembayaran) }}"
                                            class="img-fluid rounded shadow-sm" style="max-height:250px">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning mb-0">
                        Belum ada pembayaran dari customer.
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
