@extends('layouts.template')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-warning">
            <h4 class="mb-0">
                <i class="ri-edit-line"></i>
                Edit Mobil
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

            <form action="{{ route('car.update', $car->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nama Mobil
                        </label>
                        <input type="text"
                               name="nama_mobil"
                               class="form-control"
                               value="{{ old('nama_mobil', $car->nama_mobil) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Merk
                        </label>
                        <input type="text"
                               name="merk"
                               class="form-control"
                               value="{{ old('merk', $car->merk) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Tahun
                        </label>
                        <input type="number"
                               name="tahun"
                               class="form-control"
                               value="{{ old('tahun', $car->tahun) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Plat Nomor
                        </label>
                        <input type="text"
                               name="plat_nomor"
                               class="form-control"
                               value="{{ old('plat_nomor', $car->plat_nomor) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Harga Sewa / Hari
                        </label>
                        <input type="number"
                               name="harga_sewa"
                               class="form-control"
                               value="{{ old('harga_sewa', $car->harga_sewa) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select">

                            <option value="tersedia"
                                {{ $car->status == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="disewa"
                                {{ $car->status == 'disewa' ? 'selected' : '' }}>
                                Disewa
                            </option>

                            <option value="maintenance"
                                {{ $car->status == 'maintenance' ? 'selected' : '' }}>
                                Maintenance
                            </option>

                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="4"
                                  class="form-control">{{ old('deskripsi', $car->deskripsi) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Foto Mobil Baru
                        </label>

                        <input type="file"
                               name="gambar"
                               class="form-control">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti gambar
                        </small>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Foto Saat Ini
                        </label>

                        <div>

                            @if($car->gambar)

                                <img src="{{ asset('uploads/cars/'.$car->gambar) }}"
                                     class="img-thumbnail"
                                     width="250">

                            @else

                                <img src="https://via.placeholder.com/250x150"
                                     class="img-thumbnail">

                            @endif

                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('car.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-warning">
                        <i class="ri-save-line"></i>
                        Update Mobil
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
