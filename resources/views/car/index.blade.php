@extends('layouts.template')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Daftar Mobil</h2>
            <p class="text-muted">Kelola data mobil rental</p>
        </div>

        <a href="{{ route('car.create') }}" class="btn btn-primary">
            <i class="ri-add-line"></i>
            Tambah Mobil
        </a>
    </div>

    <div class="row">

        @forelse ($cars as $car)

        <div class="col-md-6 col-lg-4 mb-4">

            <div class="card border-0 shadow-sm h-100 car-card">

                <div class="position-relative">

                    @if($car->gambar)
                        <img src="{{ asset('uploads/cars/'.$car->gambar) }}"
                             class="card-img-top car-image"
                             alt="{{ $car->nama_mobil }}">
                    @else
                        <img src="https://via.placeholder.com/500x300"
                             class="card-img-top car-image"
                             alt="Mobil">
                    @endif
                    <span class="badge
                        {{ $car->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}
                        position-absolute top-0 end-0 m-3">
                        {{ ucfirst($car->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold">
                        {{ $car->nama_mobil }}
                    </h5>
                    <p class="text-muted mb-3">
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
                    <div class="bg-light rounded p-3">
                        <small class="text-muted">
                            Harga Sewa
                        </small>
                        <h4 class="text-primary fw-bold mb-0">
                            Rp {{ number_format($car->harga_sewa,0,',','.') }}
                        </h4>
                        <small class="text-muted">
                            / hari
                        </small>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="d-grid gap-2">

                        <a href="{{ route('car.edit',$car->id) }}"
                           class="btn btn-warning">
                            <i class="ri-edit-line"></i>
                            Edit
                        </a>
                        <form action="{{ route('car.delete',$car->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger w-100"
                                    onclick="return confirm('Yakin ingin menghapus mobil ini?')">
                                <i class="ri-delete-bin-line"></i>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada data mobil.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
