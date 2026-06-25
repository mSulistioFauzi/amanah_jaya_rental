@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h2 class="fw-bold">Rental Mobil</h2>
            <p class="text-muted">
                Pilih mobil yang tersedia untuk disewa
            </p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($cars as $car)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">

                        @if ($car->gambar)
                            <img src="{{ asset('uploads/cars/' . $car->gambar) }}" class="card-img-top"
                                style="height:250px; object-fit:cover;" alt="{{ $car->nama_mobil }}">
                        @else
                            <img src="https://via.placeholder.com/500x300" class="card-img-top"
                                style="height:250px; object-fit:cover;" alt="Mobil">
                        @endif

                        <div class="card-body">
                            <h5 class="fw-bold">
                                {{ $car->nama_mobil }}
                            </h5>

                            <p class="text-muted">
                                {{ $car->merk }}
                            </p>

                            <div class="row text-center mb-3">
                                <div class="col">
                                    <small class="text-muted">Tahun</small>
                                    <h6>{{ $car->tahun }}</h6>
                                </div>

                                <div class="col">
                                    <small class="text-muted">Plat</small>
                                    <h6>{{ $car->plat_nomor }}</h6>
                                </div>
                            </div>

                            <hr>

                            <p class="small text-muted">
                                {{ $car->deskripsi }}
                            </p>

                            <div class="bg-light p-3 rounded">
                                <small class="text-muted">
                                    Harga Sewa
                                </small>

                                <h4 class="text-primary fw-bold mb-0">
                                    Rp {{ number_format($car->harga_sewa, 0, ',', '.') }}
                                </h4>

                                <small class="text-muted">/ Hari</small>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <div class="d-grid">
                                <a href="{{ route('customer.rental.create', $car->id) }}" class="btn btn-primary">
                                    <i class="ri-car-line"></i>
                                    Sewa Sekarang
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Tidak ada mobil yang tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
