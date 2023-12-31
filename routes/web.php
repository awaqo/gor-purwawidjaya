<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManualBookingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function() {
    Route::get('/register', 'register')->name('register')->middleware('isLogin');
    Route::post('/register', 'doRegister')->name('do.register');
    
    Route::get('/login', 'login')->name('login')->middleware('isLogin');
    Route::post('/login', 'doLogin')->name('do.login');

    Route::get('/logout', 'logout')->name('logout');
});

// Admin
Route::group(['middleware'=>['isAdmin']], function() {
});
Route::middleware('isAdmin')->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::controller(ManualBookingController::class)->group(function() {
            Route::get('/manual-booking', 'index')->name('admin.manual-booking');
            Route::get('/manual-booking/{id}/{slug}', 'detailCourt');

            Route::post('/booking-manual', 'bookCourt')->name('admin.bookCourt')->middleware('checkLogin');
        });

        Route::controller(AdminTransactionController::class)->group(function() {
            Route::get('/transaksi', 'index')->name('admin.transaction');
            Route::get('/transaksi/detail-transaksi/{id}', 'show')->name('admin.transaction.detail');
        });
    });
});

// Customer
Route::middleware('isCustomer')->group(function() {
    Route::controller(HomeController::class)->group(function() {
        Route::get('/', 'index')->name('home');
    });

    Route::controller(TransactionController::class)->group(function() {
        Route::get('/booking/{id}/{slug}', 'detailCourt');

        Route::post('/booking-lapangan', 'bookCourt')->name('bookCourt')->middleware('checkLogin');
    });

    Route::controller(HistoryController::class)->group(function() {
        Route::get('/riwayat-pesanan', 'index')->name('riwayat-pesan')->middleware('checkLogin');
    });

    Route::controller(PaymentController::class)->group(function() {
        Route::get('/riwayat-pesanan/upload-pembayaran/{id}', 'index')->name('page.upload-pembayaran');
        Route::post('/riwayat-pesanan/upload-pembayaran/{id}', 'store')->name('upload-pembayaran');
    });
});