@extends('layouts.template')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <main class="content px-3 py-2">
        @if (Session::get('cantAccess'))
            <div class="alert alert-danger">
                {{ Session::get('cantAccess') }}
            </div>
        @endif

        <div class="container-fluid">

            <div class="mb-3">
                <h2>Dashboard Rental Mobil</h2>
            </div>

            @if (Auth::user()->role == 'admin')
                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $car }}</h3>
                                    <p>Total Mobil</p>
                                </div>
                                <i class="ri-car-fill fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $admin }}</h3>
                                    <p>Total Admin</p>
                                </div>
                                <i class="ri-user-settings-fill fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $customer }}</h3>
                                    <p>Total Customer</p>
                                </div>
                                <i class="ri-user-fill fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $rental }}</h3>
                                    <p>Total Rental</p>
                                </div>
                                <i class="ri-file-list-3-fill fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $pendingRental }}</h3>
                                    <p>Rental Pending</p>
                                </div>
                                <i class="ri-time-fill fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3>{{ $availableCar }}</h3>
                                    <p>Mobil Tersedia</p>
                                </div>
                                <i class="ri-roadster-fill fs-1"></i>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            @if (Auth::user()->role == 'customer')
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h4>Selamat Datang</h4>
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h4>Mobil Tersedia</h4>
                                <h2>{{ $availableCar }}</h2>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
@endsection
