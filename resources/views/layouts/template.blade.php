<!DOCTYPE html>

<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo d-flex align-items-center px-3 py-3">
                    {{-- <img src="{{ asset('images/logo.jpg') }}"
                        width="40"> --}}

                    <h2 class="ms-3 fw-bold fs-5">
                        Rental Mobil
                    </h2>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="{{ route('home') }}" class="sidebar-link">
                            <i class="ri-dashboard-fill"></i>
                            Dashboard
                        </a>
                    </li>
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#masterData">
                                    <i class="ri-database-2-fill"></i>
                                    Master Data
                                </a>
                                <ul id="masterData" class="sidebar-dropdown list-unstyled collapse">

                                    <li class="sidebar-item">
                                        <a href="{{ route('user.index') }}" class="sidebar-link mx-4">
                                            <i class="ri-user-fill"></i>
                                            Data User
                                        </a>
                                    </li>

                                    <li class="sidebar-item">
                                        <a href="{{ route('car.index') }}" class="sidebar-link mx-4">
                                            <i class="ri-car-fill"></i>
                                            Data Mobil
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('rental.index') }}" class="sidebar-link">
                                    <i class="ri-file-list-3-fill"></i>
                                    Data Rental
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ route('payment.index') }}" class="sidebar-link">
                                    <i class="ri-bank-card-fill"></i>
                                    Pembayaran
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ route('return.index') }}" class="sidebar-link">
                                    <i class="ri-arrow-go-back-fill"></i>
                                    Pengembalian
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role == 'customer')
                            <li class="sidebar-item">
                                <a href="{{ route('customer.cars') }}" class="sidebar-link">
                                    <i class="ri-car-fill"></i>
                                    Daftar Mobil
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ route('customer.rental.history') }}" class="sidebar-link">
                                    <i class="ri-history-fill"></i>
                                    Riwayat Rental
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </aside>

        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-ninja"></i>
                                {{ Auth::check() ? Auth::user()->name : 'Belum Login' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('logout') }}" class="dropdown-item" style="color: #fff">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-5">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
