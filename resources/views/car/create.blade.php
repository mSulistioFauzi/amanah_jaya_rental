@extends('layouts.template')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="ri-car-fill"></i>
                Tambah Mobil
            </h4>
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

            <form action="{{ route('car.store') }}"method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nama Mobil
                        </label>
                        <input type="text" name="nama_mobil" class="form-control" value="{{ old('nama_mobil') }}" placeholder="Contoh: Toyota Avanza">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Merk
                        </label>
                        <input type="text" name="merk" class="form-control" value="{{ old('merk') }}" placeholder="Contoh: Toyota">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Tahun
                        </label>
                        <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" placeholder="2024">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Plat Nomor
                        </label>
                        <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor') }}" placeholder="F 1234 ABC">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Harga Sewa / Hari
                        </label>
                        <input type="number" name="harga_sewa" class="form-control" value="{{ old('harga_sewa') }}" placeholder="350000">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select">
                            <option value="">-- Pilih Status --</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="disewa">Disewa</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Masukkan deskripsi mobil">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label">
                            Foto Mobil
                        </label>
                        <input type="file"
                               name="gambar"
                               class="form-control">
                        <small class="text-muted">
                            Format: JPG, JPEG, PNG
                        </small>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('car.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary">
                        <i class="ri-save-line"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
