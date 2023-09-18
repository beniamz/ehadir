<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashbardController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PendidikController;
use App\Http\Controllers\PresensiController;
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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::middleware(['guest:pendidik'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);  
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);  
});

Route::middleware(['auth:pendidik'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout',[AuthController::class, 'proseslogout']);
    //presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //editprofile
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    //Histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('gethistori', [PresensiController::class, 'gethistori']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);
});

Route::middleware(['auth:user'])->group(function() {
    Route::get('/proseslogoutadmin',[AuthController::class, 'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    //Pendidik
    Route::get('/pendidik', [PendidikController::class, 'index']);
    Route::post('/pendidik/store', [PendidikController::class, 'store']);
    Route::post('/pendidik/edit', [PendidikController::class, 'edit']);
    Route::post('/pendidik/{nik}/update', [PendidikController::class, 'update']);
    Route::post('/pendidik/{nik}/delete', [PendidikController::class, 'delete']);

    //status guru
    Route::get('/departemen', [DepartemenController::class, 'index']);
    Route::post('/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/departemen/{kode_dept}/update', [DepartemenController::class, 'update']);
    Route::post('/departemen/{kode_dept}/delete', [DepartemenController::class, 'delete']);

    //monitoring presensi
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta']);
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
    // Data Ajuan Izin Sakit
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
    Route::post('/presensi/approveizinsakit', [PresensiController::class, 'approveizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit', [PresensiController::class, 'batalkanizinsakit']);


    //konfigurasi
    Route::get('konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);
    
});

