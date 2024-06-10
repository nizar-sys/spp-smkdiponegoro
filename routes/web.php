<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# ------ Unauthenticated routes ------ #
Route::get('/', [AuthenticatedSessionController::class, 'create']);
require __DIR__.'/auth.php';


# ------ Authenticated routes ------ #
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('home'); # dashboard
    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'myProfile'])->name('profile');
        Route::put('/change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
        Route::put('/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
    }); # profile group

    # ------ DataTables routes ------ #
    Route::prefix('data')->name('datatable.')->group(function(){
        Route::get('/users', [DataTableController::class, 'getUsers'])->name('users');
    });

    Route::get('/datatable/users', [UserController::class, 'userDataTable'])->name('users.datatables');
    Route::resource('users', UserController::class);
    Route::resource('classes', KelasController::class);
    Route::resource('students', SiswaController::class);

    Route::get('/data-spp/pembayaran/{sppId}', [SppController::class, 'pembayaranView'])->name('data-spp.pembayaran');
    Route::post('/data-spp/pembayaran/{sppId}', [SppController::class, 'storePembayaran'])->name('data-spp.pembayaran-store');
    Route::post('/data-spp/payment', [SppController::class, 'payment'])->name('data-spp.payment');
    Route::resource('data-spp', SppController::class);
});
