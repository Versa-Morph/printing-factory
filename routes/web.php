<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GajiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::check() != null) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

// START FORGOT PASSWORD 
Route::prefix('forgot-password')->name('forgot-password-')->group(function () {
    Route::get('/', [ForgotPasswordController::class, 'index'])->name('view');
    Route::post('/send-email', [ForgotPasswordController::class, 'sendEmail'])->name('send-email');
    Route::get('/reset-password', [ForgotPasswordController::class, 'reset'])->name('reset-password');
    Route::post('/proses-reset-password', [ForgotPasswordController::class, 'prosesReset'])->name('proses-reset-password');
});
// END FORGOT PASSWORD 

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



// START PELANGGAN 
Route::prefix('pelanggan')->name('pelanggan-')->group(function () {
    Route::get('/', [PelangganController::class, 'index'])->name('list');
    Route::get('/get-data', [PelangganController::class, 'getData'])->name('get-data');
    Route::get('/create', [PelangganController::class, 'create'])->name('create');
    Route::post('/store', [PelangganController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PelangganController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PelangganController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PelangganController::class, 'delete'])->name('delete');
});
// END PELANGGAN 


// START Karyawan 
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('/karyawan-get-data', [KaryawanController::class, 'getData'])->name('karyawan-get-data');
Route::get('/karyawan-create', [KaryawanController::class, 'create'])->name('karyawan-create');
Route::post('/karyawan-store', [KaryawanController::class, 'store'])->name('karyawan-store');
Route::get('/karyawan-edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan-edit');
Route::post('/karyawan-update/{id}', [KaryawanController::class, 'update'])->name('karyawan-update');
Route::get('/karyawan-delete/{id}', [KaryawanController::class, 'delete'])->name('karyawan-delete');
// END Karyawan 

// START GAJI
Route::prefix('gaji')->name('gaji-')->group(function () {
    Route::get('/', [GajiController::class, 'index'])->name('list');
    Route::get('/get-data', [GajiController::class, 'getData'])->name('get-data');
    Route::get('/get-data-karyawan/{id}', [GajiController::class, 'getDataKaryawan'])->name('get-data-karyawan');
    Route::get('/create', [GajiController::class, 'create'])->name('create');
    Route::post('/store', [GajiController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GajiController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GajiController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [GajiController::class, 'delete'])->name('delete');
}); 
// END GAJI 

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);
