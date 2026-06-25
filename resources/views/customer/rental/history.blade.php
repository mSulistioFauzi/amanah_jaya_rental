@extends('layouts.template')

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Riwayat Rental</h2>
                <p class="text-muted">
                    Daftar penyewaan mobil yang pernah Anda lakukan
                </p>
            </div>
        </div>

        ```
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Lama Sewa</th>
                                <th>Total Harga</th>
                                <th>Status Rental</th>
                                <th>Pembayaran</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($rentals as $key => $rental)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        <strong>{{ $rental->car->nama_mobil }}</strong><br>
                                        <small class="text-muted">
                                            {{ $rental->car->plat_nomor }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}
                                    </td>

                                    <td>{{ $rental->lama_sewa }} Hari</td>

                                    <td>
                                        Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @if ($rental->status == 'pending')
                                            <span class="badge bg-warning">
                                                Menunggu Persetujuan
                                            </span>
                                        @elseif($rental->status == 'disetujui')
                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>
                                        @elseif($rental->status == 'ditolak')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @elseif($rental->status == 'selesai')
                                            <span class="badge bg-primary">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($rental->status == 'disetujui')
                                            @if ($rental->payments->count() > 0)
                                                @php
                                                    $payment = $rental->payments->first();
                                                @endphp

                                                @if ($payment->status == 'menunggu')
                                                    <span class="badge bg-warning">
                                                        Menunggu Verifikasi
                                                    </span>
                                                @elseif($payment->status == 'diterima')
                                                    <span class="badge bg-success">
                                                        Pembayaran Diterima
                                                    </span>
                                                @elseif($payment->status == 'ditolak')
                                                    <span class="badge bg-danger">
                                                        Pembayaran Ditolak
                                                    </span>
                                                @endif
                                            @else
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#paymentModal{{ $rental->id }}">
                                                    Upload Bukti
                                                </button>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                                {{-- Modal Upload Pembayaran --}}
                                <div class="modal fade" id="paymentModal{{ $rental->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('customer.payment.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="rental_id" value="{{ $rental->id }}">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Upload Bukti Pembayaran
                                                    </h5>

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Total Pembayaran
                                                        </label>

                                                        <input type="text" class="form-control"
                                                            value="Rp {{ number_format($rental->total_harga, 0, ',', '.') }}"
                                                            readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Bukti Pembayaran
                                                        </label>

                                                        <input type="file" name="bukti_pembayaran" class="form-control"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Tutup
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada riwayat rental.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        ```

    </div>
@endsection
