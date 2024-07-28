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
Route::prefix('pelanggan')->name('pelanggan-')->group(function (){ 
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

// START ROLE
// Route::prefix('roles')->name('roles-')->group(function () {
//     Route::get('/', [RoleController::class, 'index'])->name('list');
//     Route::get('get-data', [RoleController::class, 'getRoles'])->name('get-data');
//     Route::get('get-permissions/{roleId}', [RoleController::class, 'getPermissions'])->name('get-permissions');
//     Route::get('{roleId}/permissions', [RoleController::class, 'getPermissions'])->name('permissions');
//     Route::get('permissions/get-all', [RoleController::class, 'getAllPermissions'])->name('get-all');
//     Route::get('modal-add', [RoleController::class, 'getModalAdd'])->name('modal-add');
//     Route::post('store', [RoleController::class, 'store'])->name('store');
//     Route::get('modal-edit/{roleId}', [RoleController::class, 'getModalEdit'])->name('modal-edit');
//     Route::put('update/{roleId}', [RoleController::class, 'update'])->name('update');
//     Route::get('modal-delete/{roleId}', [RoleController::class, 'getModalDelete'])->name('modal-delete');
//     Route::delete('delete/{roleId}', [RoleController::class, 'destroy'])->name('destroy');
//     Route::post('update-permission', [RoleController::class, 'updatePermissionByID'])->name('update.permission');
//     Route::post('update-all-permissions', [RoleController::class, 'updateAllPermissions'])->name('update.permission');
// });

// Roles
Route::prefix('roles')->name('roles.')->group(function () {
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

// END ROLE

Route::resources([
    // 'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);