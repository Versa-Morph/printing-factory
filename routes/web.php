<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DesainProductController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GajiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalProduksiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PwaController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RencanaProduksiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\WorkScheduleController;
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
    return redirect('homepage');
});

Route::post('/send-login', [LoginController::class, 'login'])->name('send-login');

// REDIRECT SCREEN FOR ADMIN
Route::get('/please-wait', [HomeController::class, 'redirectPage'])->name('please-wait');
Route::post('/update-dashboard-view', [HomeController::class, 'updateDashboardView'])->name('update-dashboard-view');

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
Route::get('/dashboard-sales', function() {
    return view('dashboard.sales');
})->name('dashboard.sales');

Route::get('/homepage', [HomeController::class, 'homepage'])->name('homepage');
Route::get('/homepage-role', [HomeController::class, 'homepageRole'])->name('homepage-role');
Route::get('/absensi', function(){
return view('absensi.index');
})->name('absensi');

// PWA 

Route::prefix('pwa')->name('pwa-')->group(function () {
    Route::get('/homepage', [PwaController::class, 'index'])->name('homepage');
});

// END PWA 

Route::get('/form-customer', [HomeController::class, 'formCustomer'])->name('form-customer');


Route::prefix('customer')->name('customer-')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('list');
    Route::get('/data', [CustomerController::class, 'getData'])->name('get-data');
    Route::post('/form-store', [CustomerController::class, 'storeForm'])->name('form-store');
    Route::get('/change-status/{id}', [CustomerController::class, 'changeCustomerStatus'])->name('change-status');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CustomerController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
});
Route::prefix('leads-customer')->name('leads-customer-')->group(function () {
    Route::get('/', [CustomerController::class, 'indexLeads'])->name('list');
    Route::get('/data', [CustomerController::class, 'getDataLeads'])->name('get-data');
    Route::get('/create', [CustomerController::class, 'createLeads'])->name('create');
    Route::post('/store', [CustomerController::class, 'storeLeads'])->name('store');
    Route::get('/edit/{id}', [CustomerController::class, 'editLeads'])->name('edit');
    Route::post('/update/{id}', [CustomerController::class, 'updateLeads'])->name('update');
    Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
});

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

// START ORDER
Route::prefix('order')->name('order-')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('list');
    Route::get('/get-data', [OrderController::class, 'getData'])->name('get-data');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [OrderController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('delete');
});
// END ORDER

// START JADWAL PRODUKSI
Route::prefix('jadwal-produksi')->name('jadwal-produksi-')->group(function () {
    Route::get('/', [JadwalProduksiController::class, 'index'])->name('list');
    Route::get('/get-data', [JadwalProduksiController::class, 'getData'])->name('get-data');
    Route::get('/create', [JadwalProduksiController::class, 'create'])->name('create');
    Route::post('/store', [JadwalProduksiController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [JadwalProduksiController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [JadwalProduksiController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [JadwalProduksiController::class, 'delete'])->name('delete');
});
// END JADWAL PRODUKSI

// START LAPORAN PRODUKSI
Route::prefix('laporan-produksi')->name('laporan-produksi-')->group(function () {
    Route::get('/', [LaporanProduksiController::class, 'index'])->name('list');
    Route::get('/get-data', [LaporanProduksiController::class, 'getData'])->name('get-data');
    Route::get('/create', [LaporanProduksiController::class, 'create'])->name('create');
    Route::post('/store', [LaporanProduksiController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [LaporanProduksiController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [LaporanProduksiController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [LaporanProduksiController::class, 'delete'])->name('delete');
});
// END LAPORAN PRODUKSI

// START QUOTATION
Route::prefix('quotation')->name('quotation-')->group(function () {
    Route::get('/', [QuotationController::class, 'index'])->name('list');
    Route::get('/get-data', [QuotationController::class, 'getData'])->name('get-data');
    Route::get('/create', [QuotationController::class, 'create'])->name('create');
    Route::post('/store', [QuotationController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [QuotationController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [QuotationController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [QuotationController::class, 'delete'])->name('delete');
    Route::get('/modal-approve/{id}', [QuotationController::class, 'modalApprove'])->name('modal-approve');
    Route::patch('/approve/{id}', [QuotationController::class, 'approve'])->name('approve');
});
// END QUOTATION

// START SHIFT
Route::prefix('shift')->name('shift-')->group(function () {
    Route::get('/', [ShiftController::class, 'index'])->name('list');
    Route::get('/get-data', [ShiftController::class, 'getData'])->name('get-data');
    Route::get('/create', [ShiftController::class, 'create'])->name('create');
    Route::post('/store', [ShiftController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ShiftController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ShiftController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ShiftController::class, 'delete'])->name('delete');
    Route::get('/modal-approve/{id}', [ShiftController::class, 'modalApprove'])->name('modal-approve');
    Route::patch('/approve/{id}', [ShiftController::class, 'approve'])->name('approve');
});
// END SHIFT

// START HR WORK SCHEDULE
Route::prefix('hr')->name('hr-')->group(function (){
    Route::get('/work-schedule', [WorkScheduleController::class, 'hrWorkScheduleIndex'])->name('work-schedule-list');
    Route::get('/work-schedule-get-data', [WorkScheduleController::class, 'getData'])->name('work-schedule-get-data');
    Route::get('/work-schedule-create', [WorkScheduleController::class, 'create'])->name('work-schedule-create');
    Route::post('/work-schedule-store', [WorkScheduleController::class, 'store'])->name('work-schedule-store');
    Route::get('/work-schedule-edit/{id}', [WorkScheduleController::class, 'edit'])->name('work-schedule-edit');
    Route::post('/work-schedule-update/{id}', [WorkScheduleController::class, 'update'])->name('work-schedule-update');
    Route::get('/work-schedule-delete/{id}', [WorkScheduleController::class, 'delete'])->name('work-schedule-delete');
});
// END HR WORK SCHEDULE

// START ABSENCE
Route::prefix('absence')->name('absence-')->group(function (){
    Route::get('/', [AbsenceController::class, 'index'])->name('list');
    Route::get('/get-data', [AbsenceController::class, 'getData'])->name('get-data');
    Route::get('/create', [AbsenceController::class, 'create'])->name('create');
    Route::post('/store', [AbsenceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AbsenceController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [AbsenceController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [AbsenceController::class, 'delete'])->name('delete');

    // Queue
    Route::get('/queue', [AbsenceController::class, 'indexQueue'])->name('list-queue');
    Route::get('/get-data-queue', [AbsenceController::class, 'getDataQueue'])->name('get-data-queue');

    // History
    Route::get('/history', [AbsenceController::class, 'indexHistory'])->name('list-history');
    Route::get('/get-data-history', [AbsenceController::class, 'getDataHistory'])->name('get-data-history');
});
// END ABSENCE

// START RECEIVE ORDER
Route::prefix('receive-order')->name('receive-order-')->group(function () {
    Route::get('/', [QuotationController::class, 'receiveOrder'])->name('list');
    Route::get('/get-data', [QuotationController::class, 'getDataReceiveOrder'])->name('get-data');
});
// END RECEIVE ORDER

// Payroll
Route::get('/payroll', function() {
    return view('payroll.index');
})->name('payroll.list');
// End Payroll
// START ATTENDANCE
Route::prefix('attendance')->name('attendance-')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('list');
});
Route::prefix('overtime')->name('overtime-')->group(function () {
    Route::get('/', [OvertimeController::class, 'index'])->name('list');
});
// Route::prefix('absence')->name('absence-')->group(function () {
//     Route::get('/', [AbsenceController::class, 'index'])->name('list');
// });
Route::prefix('work-schedule')->name('work-schedule-')->group(function () {
    Route::get('/', [WorkScheduleController::class, 'index'])->name('list');
});
// END ATTENDANCE

// START EMPLOYE 
Route::prefix('employe')->name('employe-')->group(function () {
    Route::get('/', [EmployeController::class, 'index'])->name('list');
    Route::get('/get-data', [EmployeController::class, 'getData'])->name('get-data');
    Route::get('/create', [EmployeController::class, 'create'])->name('create');
    Route::post('/store', [EmployeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [EmployeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [EmployeController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [EmployeController::class, 'delete'])->name('delete');
});
// END EMPLOYE 

// START EMPLOYEE SALARY 
Route::prefix('employee-salary')->name('employee-salary-')->group(function () {
    Route::get('/', [EmployeeSalaryController::class, 'index'])->name('list');
    Route::get('/get-data', [EmployeeSalaryController::class, 'getData'])->name('get-data');
    Route::get('/create', [EmployeeSalaryController::class, 'create'])->name('create');
    Route::post('/store', [EmployeeSalaryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [EmployeeSalaryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [EmployeeSalaryController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [EmployeeSalaryController::class, 'delete'])->name('delete');
});
// END EMPLOYE SALARY



Route::resources([
    // 'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);
