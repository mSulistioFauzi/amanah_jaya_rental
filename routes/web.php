<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\ReturnsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('IsGuest')->group(function () {
    Route::get('/', function() {
        return view('login');
    })->name('login');
    Route::get('/login', [UsersController::class, 'loginAuth'])->name('login.auth');
});

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/home', [UsersController::class, 'dashboard'] )->name('home');

    Route::middleware(['IsAdmin'])->group(function(){

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UsersController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UsersController::class, 'destroy'])->name('delete');
        });

        Route::prefix('car')->name('car.')->group(function () {
            Route::get('/', [CarsController::class, 'index'])->name('index');
            Route::get('/create', [CarsController::class, 'create'])->name('create');
            Route::post('/store', [CarsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CarsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [CarsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CarsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('rental')->name('rental.')->group(function () {
            Route::get('/', [RentalsController::class, 'index'])->name('index');
            Route::get('/detail/{id}', [RentalsController::class, 'show'])->name('show');
            Route::patch('/approve/{id}', [RentalsController::class, 'approve'])->name('approve');
            Route::patch('/reject/{id}', [RentalsController::class, 'reject'])->name('reject');
        });

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/', [PaymentsController::class, 'index'])->name('index');
            Route::patch('/approve/{id}', [PaymentsController::class, 'approve'])->name('approve');
            Route::patch('/reject/{id}', [PaymentsController::class, 'reject'])->name('reject');
        });

        Route::prefix('return')->name('return.')->group(function () {
            Route::get('/', [ReturnsController::class, 'index'])->name('index');
            Route::post('/store', [ReturnsController::class, 'store'])->name('store');
        });
    });

    Route::middleware(['IsCustomer'])->group(function () {

        Route::prefix('customer')->name('customer.')->group(function () {
            Route::get('/cars', [CarsController::class, 'list']) ->name('cars');
            Route::get('/rental/create/{id}', [RentalsController::class, 'create']) ->name('rental.create');
            Route::post('/rental/store', [RentalsController::class, 'store']) ->name('rental.store');
            Route::get('/rental/history', [RentalsController::class, 'history']) ->name('rental.history');
            Route::post('/payment/store', [PaymentsController::class, 'store']) ->name('payment.store'); });
    });
});
