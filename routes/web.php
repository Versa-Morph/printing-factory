<?php

use App\Http\Controllers\DesainProductController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GajiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RencanaProduksiController;
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
Route::prefix('karyawan')->name('karyawan-')->group(function (){ 
    Route::get('/', [KaryawanController::class, 'index'])->name('list');
    Route::get('/karyawan-get-data', [KaryawanController::class, 'getData'])->name('get-data');
    Route::get('/karyawan-create', [KaryawanController::class, 'create'])->name('create');
    Route::post('/karyawan-store', [KaryawanController::class, 'store'])->name('store');
    Route::get('/karyawan-edit/{id}', [KaryawanController::class, 'edit'])->name('edit');
    Route::post('/karyawan-update/{id}', [KaryawanController::class, 'update'])->name('update');
    Route::get('/karyawan-delete/{id}', [KaryawanController::class, 'delete'])->name('delete');
});
// END Karyawan 

// START ROLES
Route::prefix('roles')->name('roles-')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('get-data', [RoleController::class, 'getRoles'])->name('get-data');
    Route::get('modal-add', [RoleController::class, 'getModalAdd'])->name('modal-add');
    Route::post('store', [RoleController::class, 'store'])->name('store');
    Route::get('modal-edit/{roleId}', [RoleController::class, 'getModalEdit'])->name('modal-edit');
    Route::put('update/{roleId}', [RoleController::class, 'update'])->name('update');
    Route::get('modal-delete/{roleId}', [RoleController::class, 'getModalDelete'])->name('modal-delete');
    Route::delete('delete/{roleId}', [RoleController::class, 'destroy'])->name('destroy');
    Route::post('update-permission', [RoleController::class, 'updatePermissionByID'])->name('update.permission');
    Route::post('update-all-permissions', [RoleController::class, 'updateAllPermissions'])->name('update.permission');
});

// END ROLES
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

// START Desain Product 
Route::prefix('desain-product')->name('desain-product-')->group(function (){ 
    Route::get('/', [DesainProductController::class, 'index'])->name('list');
    Route::get('/desain-product-get-data', [DesainProductController::class, 'getData'])->name('get-data');
    Route::get('/desain-product-create', [DesainProductController::class, 'create'])->name('create');
    Route::post('/desain-product-store', [DesainProductController::class, 'store'])->name('store');
    Route::get('/desain-product-edit/{id}', [DesainProductController::class, 'edit'])->name('edit');
    Route::post('/desain-product-update/{id}', [DesainProductController::class, 'update'])->name('update');
    Route::get('/desain-product-delete/{id}', [DesainProductController::class, 'delete'])->name('delete');
});
// END Desain Product 

// START Desain Product 
Route::prefix('rencana-produksi')->name('rencana-produksi-')->group(function (){ 
    Route::get('/', [RencanaProduksiController::class, 'index'])->name('list');
    Route::get('/rencana-produksi-get-data', [RencanaProduksiController::class, 'getData'])->name('get-data');
    Route::get('/rencana-produksi-create', [RencanaProduksiController::class, 'create'])->name('create');
    Route::post('/rencana-produksi-store', [RencanaProduksiController::class, 'store'])->name('store');
    Route::get('/rencana-produksi-edit/{id}', [RencanaProduksiController::class, 'edit'])->name('edit');
    Route::post('/rencana-produksi-update/{id}', [RencanaProduksiController::class, 'update'])->name('update');
    Route::get('/rencana-produksi-delete/{id}', [RencanaProduksiController::class, 'delete'])->name('delete');
});
// END Desain Product 

Route::resources([
    // 'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);
