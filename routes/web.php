<?php

use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManualBookingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Admin\MapsController;
use App\Http\Controllers\Admin\FacilityController;
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

        Route::controller(AdminTransactionController::class)->group(function() {
            Route::get('/transaksi', 'getAll')->name('admin.transaction');
            Route::get('/transaksi/detail-transaksi/{id}', 'detailTransaction')->name('admin.transaction.detail');

            Route::get('/transaksi/konfirmasi/{id}', 'confirmTransaction')->name('admin.transaction.confirm');
            Route::get('/transaksi/selesaikan-transaksi/{id}', 'endTransaction')->name('admin.transaction.end');
        });

        Route::controller(ManualBookingController::class)->group(function() {
            Route::get('/manual-booking', 'index')->name('admin.manual-booking');
            Route::get('/manual-booking/{id}/{slug}', 'detailCourt');

            Route::post('/booking-manual', 'bookCourt')->name('admin.bookCourt')->middleware('checkLogin');
        });

        Route::controller(CourtController::class)->group(function() {
            Route::get('/kelola-lapangan', 'getAll')->name('admin.court.manage');
            Route::get('/kelola-lapangan/{id}/edit', 'editCourt')->name('admin.court.edit');
            Route::get('/kelola-lapangan/add', 'addCourt')->name('admin.court.add');

            Route::put('/edit-lapangan/{id}', 'updateCourt');
            Route::post('/add-lapangan', 'storeCourt');

            Route::post('/delete-lapangan', 'destroyCourt')->name('admin.court.delete');
            
            // detail lapangan
            Route::get('/kelola-lapangan/detail-lapangan/{id}', 'show')->name('admin.court.detail');
            Route::get('/kelola-lapangan/detail-lapangan/{id}/edit', 'editPhoto')->name('admin.court.edit-photo');
            Route::get('/kelola-lapangan/detail-lapangan/{id}/add', 'addPhoto')->name('admin.court.add-photo');

            Route::put('/edit-foto-lapangan/{id}', 'updatePhoto');
            Route::post('/add-foto-lapangan', 'storePhoto');

            Route::post('/delete-foto-lapangan', 'destroyPhoto')->name('admin.court.delete-photo');
        });
        
        // Informasi Umum
        Route::prefix('umum')->group(function() {
            Route::controller(CompetitionController::class)->group(function() {
                Route::get('/perlombaan', 'index')->name('admin.competition');
            });
    
            Route::controller(MapsController::class)->group(function() {
                Route::get('/maps', 'index')->name('admin.maps');
                Route::get('/maps/add', 'create')->name('admin.maps.create');
                Route::get('/maps/edit/{id}', 'edit')->name('admin.maps.edit');
                
                Route::post('/add-maps', 'store');
                Route::put('/edit-maps/{id}', 'update');

                Route::post('/delete-maps', 'destroy')->name('admin.maps.delete');
            });

            Route::controller(FacilityController::class)->group(function() {
                Route::get('/fasilitas', 'index')->name('admin.facility');
                Route::get('/fasilitas/add', 'create')->name('admin.facility.create');
                Route::get('/fasilitas/edit/{id}', 'edit')->name('admin.facility.edit');
                
                Route::post('/add-fasilitas', 'store');
                Route::put('/edit-fasilitas/{id}', 'update');

                Route::post('/delete-fasilitas', 'destroy')->name('admin.facility.delete');
            });
        });
    });
});

// Customer
Route::middleware('isCustomer')->group(function() {
    Route::controller(HomeController::class)->group(function() {
        Route::get('/', 'index')->name('home');
    });

    Route::controller(TransactionController::class)->group(function() {
        Route::get('/booking/{id}/{slug}', 'detailCourt')->name('booking.form');

        Route::post('/booking-lapangan', 'bookCourt')->name('bookCourt')->middleware('checkLogin');
    });

    Route::controller(HistoryController::class)->group(function() {
        Route::get('/riwayat-pesanan', 'index')->name('riwayat-pesan')->middleware('checkLogin');
    });

    Route::controller(PaymentController::class)->group(function() {
        Route::get('/riwayat-pesanan/upload-pembayaran/{id}', 'index')->name('page.upload-pembayaran');
        Route::post('/riwayat-pesanan/upload-pembayaran/{id}', 'storePayment')->name('upload-pembayaran');
    });
});