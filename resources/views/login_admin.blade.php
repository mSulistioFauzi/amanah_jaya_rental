{{-- @extends('layouts.auth')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

<div class="container login-page">
    <div class="row justify-content-center w-100">
        <div class="col-xl-9 col-lg-10">

            <div class="card login-card admin-card">
                <div class="row g-0">
                    <div class="col-lg-5 login-left admin-left d-flex flex-column justify-content-center">

                        <div>
                            <i class="ri-shield-user-fill display-2 mb-4"></i>

                            <h2>Admin Panel</h2>

                            <p class="mt-3">
                                Kelola data mobil, pengguna,
                                rental, pembayaran, dan pengembalian
                                melalui halaman administrator.
                            </p>

                            <img src="{{ asset('images/admin-login.png') }}"
                                class="img-fluid mt-4"
                                alt="Admin Login">
                        </div>

                    </div>

                    <div class="col-lg-7 login-right">

                        <div class="text-center mb-4">

                            <div class="login-icon admin-icon">
                                <i class="ri-admin-fill"></i>
                            </div>

                            <h2 class="fw-bold">
                                Login Administrator
                            </h2>

                            <p class="text-muted">
                                Masuk menggunakan akun administrator
                            </p>

                        </div>

                        @if(session('failed'))
                            <div class="alert alert-danger">
                                {{ session('failed') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.login.auth') }}" method="POST">
                            @csrf

                            <div class="mb-3">

                                <label class="form-label">
                                    Email Admin
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="ri-mail-fill"></i>
                                    </span>

                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Masukkan Email Admin"
                                        value="{{ old('email') }}"
                                        required>

                                </div>

                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    Password
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="ri-lock-password-fill"></i>
                                    </span>

                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Masukkan Password"
                                        required>

                                </div>

                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="d-grid">

                                <button class="btn btn-dark btn-login">

                                    <i class="ri-shield-keyhole-fill me-2"></i>

                                    Login Admin

                                </button>

                            </div>

                        </form>

                        <hr>

                        <div class="text-center">

                            <a href="{{ route('login') }}"
                                class="register-link">

                                <i class="ri-arrow-left-line"></i>

                                Kembali ke Login Customer

                            </a>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection --}}
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

                    <div class="col-lg-5 login-left admin-left d-flex flex-column justify-content-center">
                        <div>
                            <i class="ri-shield-user-fill display-2 mb-4"></i>
                            <h2>Admin Panel</h2>
                            <p class="mt-3">
                                Kelola data mobil, pengguna,
                                rental, pembayaran, dan pengembalian
                                melalui halaman administrator.
                            </p>
                            <img src="{{ asset('images/admin-login.png') }}"
                                class="img-fluid mt-4"
                                alt="Admin Login">
                        </div>
                    </div>

                    <div class="col-lg-7 login-right">
                        <div class="text-center mb-4">
                            <div class="login-icon admin-icon">
                                <i class="ri-admin-fill"></i>
                            </div>
                            <h2 class="fw-bold">
                                Login Administrator
                            </h2>
                            <p class="text-muted">
                                Masuk menggunakan akun administrator
                            </p>
                        </div>

                        @if(session('failed'))
                            <div class="alert alert-danger">
                                {{ session('failed') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.login.auth') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email Admin</label>

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

                            <div class="d-grid">
                                <button class="btn btn-primary btn-login">
                                    <i class="ri-shield-keyhole-fill me-2"></i>
                                    Login Admin
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="ri-admin-line me-1"></i>
                                Login sebagai Customer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
