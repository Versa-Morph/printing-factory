<?php

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
    }else{
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



// START PELANGGAN 
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
Route::get('/pelanggan-get-data', [PelangganController::class, 'getData'])->name('pelanggan-get-data');
Route::get('/pelanggan-create', [PelangganController::class, 'create'])->name('pelanggan-create');
Route::post('/pelanggan-store', [PelangganController::class, 'store'])->name('pelanggan-store');
Route::get('/pelanggan-edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan-edit');
Route::post('/pelanggan-update/{id}', [PelangganController::class, 'update'])->name('pelanggan-update');
Route::get('/pelanggan-delete/{id}', [PelangganController::class, 'delete'])->name('pelanggan-delete');
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

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);