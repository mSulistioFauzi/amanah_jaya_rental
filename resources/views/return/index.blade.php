@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <h2 class="fw-bold mb-4">Data Pengembalian</h2>

        <div class="row">
            @forelse($returns as $return)
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold">
                                {{ $return->rental->car->nama_mobil }}
                            </h5>

                            <p class="text-muted">
                                {{ $return->rental->user->name }}
                            </p>

                            <hr>

                            <p>
                                <strong>Tanggal Pengembalian</strong><br>
                                {{ $return->tanggal_pengembalian }}
                            </p>

                            <p>
                                <strong>Terlambat</strong><br>
                                {{ $return->terlambat_hari }} Hari
                            </p>

                            <h5 class="text-danger">
                                Denda: Rp {{ number_format($return->denda, 0, ',', '.') }}
                            </h5>

                            <p class="mb-0">
                                {{ $return->keterangan }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Belum ada data pengembalian.
                </div>
            @endforelse
        </div>
    </div>
@endsection
