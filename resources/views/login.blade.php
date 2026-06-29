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
                            <h2 class="fw-bold mb-1">Login Customer</h2>

                            <p class="text-muted">
                                Silakan masuk ke akun Anda
                            </p>
                        </div>

                        @if(session('failed'))
                            <div class="alert alert-danger">
                                {{ session('failed') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('login.auth') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ri-mail-fill"></i>
                                    </span>

                                    <input type="email" name="email" class="form-control"
                                           placeholder="Masukkan Email"
                                           value="{{ old('email') }}"
                                           autocomplete="email"
                                           required>
                                </div>

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password</label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ri-lock-fill"></i>
                                    </span>

                                    <input type="password" name="password" class="form-control"
                                           placeholder="Masukkan Password"
                                           autocomplete="current-password"
                                           required>
                                </div>

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="ri-login-box-line me-2"></i>
                                    Login
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            Belum memiliki akun?

                            <a href="{{ route('register') }}" class="register-link">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
