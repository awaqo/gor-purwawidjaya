<?php

use App\Http\Controllers\Admin\ManualBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/check-sch', [TransactionController::class, 'checkSch'])->name('check-sch');
Route::post('/show-sch', [TransactionController::class, 'showSchedule'])->name('show-sch');

Route::post('/update-status', [HomeController::class, 'updateStatus'])->name('update-status');
Route::post('/update-status', [ManualBookingController::class, 'updateStatus'])->name('update-status');