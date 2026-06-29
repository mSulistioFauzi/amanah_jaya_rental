@extends('layouts.template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

<div class="container login-page">
    <div class="row justify-content-center w-100">
        <div class="col-xl-9 col-lg-10">
            <div class="card login-card">
                <div class="row g-0">
                    <div class="col-lg-5 login-left d-flex flex-column justify-content-center">

                        <div>
                            <i class="ri-steering-2-fill display-3 mb-4"></i>
                            <h2>Rental Mobil</h2>
                            <p class="mt-3">
                                Temukan mobil terbaik untuk perjalanan Anda
                                dengan proses penyewaan yang mudah,
                                cepat, aman, dan terpercaya.
                            </p>

                            <img src="{{ asset('images/car-login.png') }}"
                                 class="img-fluid mt-4"
                                 alt="Rental Mobil">
                        </div>
                    </div>

                    <div class="col-lg-7 login-right">
                        <div class="text-center mb-4">
                            <div class="login-icon">
                                <i class="ri-user-3-fill"></i>
                            </div>
                            <h2 class="fw-bold mb-1">Registrasi Customer</h2>

                            <p class="text-muted">
                                Lengkapi data di bawah ini
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" rows="3" class="form-control" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password">
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="ri-user-add-line me-1"></i>
                                    Daftar Sekarang
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="register-link">
                                    Login di sini
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

