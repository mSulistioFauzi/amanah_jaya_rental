@extends('layouts.template')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Form Rental Mobil</h4>
                    </div>
                    
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('customer.rental.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                            <div class="row">
                                <div class="col-md-5">
                                    @if ($car->gambar)
                                        <img src="{{ asset('uploads/cars/' . $car->gambar) }}"
                                            class="img-fluid rounded shadow-sm">
                                    @else
                                        <img src="https://via.placeholder.com/500x300" class="img-fluid rounded">
                                    @endif
                                </div>

                                <div class="col-md-7">
                                    <h3 class="fw-bold">{{ $car->nama_mobil }}</h3>
                                    <p class="text-muted">{{ $car->merk }}</p>

                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="150">Tahun</th>
                                            <td>: {{ $car->tahun }}</td>
                                        </tr>

                                        <tr>
                                            <th>Plat Nomor</th>
                                            <td>: {{ $car->plat_nomor }}</td>
                                        </tr>

                                        <tr>
                                            <th>Harga Sewa</th>
                                            <td>
                                                : Rp {{ number_format($car->harga_sewa, 0, ',', '.') }}/hari
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Sewa</label>

                                    <input type="date" name="tanggal_sewa" class="form-control" min="{{ date('Y-m-d') }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Kembali</label>

                                    <input type="date" name="tanggal_kembali" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Deskripsi Mobil
                                </label>

                                <textarea class="form-control" rows="4" readonly>{{ $car->deskripsi }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('customer.cars') }}" class="btn btn-secondary">
                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-car-line"></i>
                                    Ajukan Rental
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
