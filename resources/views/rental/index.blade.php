@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Data Rental Mobil</h4>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Lama Sewa</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th width="250">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($rentals as $key => $rental)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $rental->user->name }}</td>
                                    <td>{{ $rental->car->nama_mobil }}</td>
                                    <td>{{ $rental->tanggal_sewa }}</td>
                                    <td>{{ $rental->tanggal_kembali }}</td>
                                    <td>{{ $rental->lama_sewa }} Hari</td>
                                    <td>Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>

                                    <td>
                                        @if ($rental->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($rental->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($rental->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary">
                                                {{ ucfirst($rental->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('rental.show', $rental->id) }}" class="btn btn-info btn-sm">
                                            Detail
                                        </a>

                                        @if ($rental->status == 'pending')
                                            <form action="{{ route('rental.approve', $rental->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-success btn-sm">
                                                    Approve
                                                </button>
                                            </form>

                                            <form action="{{ route('rental.reject', $rental->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-danger btn-sm">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Belum ada data rental.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
