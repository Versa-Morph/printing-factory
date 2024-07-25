<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);