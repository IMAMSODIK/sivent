<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NarasumberController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\RundownController;
use App\Http\Controllers\UnitKerjaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginCheck']);
});

Route::middleware('auth')->group(function(){
    Route::get("/dashboard", [DashboardController::class, 'index']);
    
    Route::get("/rapat", [RapatController::class, 'index']);
    Route::get("/meeting", [MeetingController::class, 'index']);
    Route::get("/lembur", [LemburController::class, 'index']);
    Route::get("/event/edit", [RapatController::class, 'edit']);
    Route::post("/event/update", [RapatController::class, 'update']);
    Route::post("/event/delete", [RapatController::class, 'delete']);
    Route::get("/event/filter", [RapatController::class, 'filter']);
    Route::post("/rapat/store", [RapatController::class, 'store']);

    Route::get("/data-peserta", [PesertaController::class, 'index']);
    Route::get("/data-peserta/daftar-peserta", [PesertaController::class, 'daftarPeserta']);
    Route::post("/data-peserta/daftar-peserta/store", [PesertaController::class, 'store']);
    Route::get("/data-peserta/daftar-event", [PesertaController::class, 'daftarEvent']);

    Route::get("/data-narasumber", [NarasumberController::class, 'index']);
    Route::get("/data-narasumber/daftar-narasumber", [NarasumberController::class, 'daftarNarasumber']);
    Route::post("/data-narasumber/daftar-narasumber/store", [NarasumberController::class, 'store']);

    Route::get("/data-bank", [BankController::class, 'index']);
    Route::post("/data-bank/store", [BankController::class, 'store']);
    Route::get("/data-bank/edit", [BankController::class, 'edit']);
    Route::post("/data-bank/update", [BankController::class, 'update']);
    Route::post("/data-bank/delete", [BankController::class, 'delete']);

    Route::get("/data-rundown", [RundownController::class, 'index']);
    Route::post("/data-rundown/store", [RundownController::class, 'store']);

    Route::get("/registrasi-peserta", [PesertaController::class, 'registrasi']);
    Route::get("/registrasi-peserta/daftar-peserta", [PesertaController::class, 'daftarRegistrasiPeserta']);
    // Route::post("/registrasi-peserta/daftar-peserta/store", [NarasumberController::class, 'store']);

    Route::get("/data-unit-kerja", [UnitKerjaController::class, 'index']);
    Route::post("/data-unit-kerja/store", [UnitKerjaController::class, 'store']);
    Route::get("/data-unit-kerja/edit", [UnitKerjaController::class, 'edit']);
    Route::post("/data-unit-kerja/update", [UnitKerjaController::class, 'update']);
    Route::post("/data-unit-kerja/delete", [UnitKerjaController::class, 'delete']);

    Route::get("/data-pegawai", [PegawaiController::class, 'index']);
    Route::post("/data-pegawai/store", [PegawaiController::class, 'store']);
    Route::get("/data-pegawai/edit", [PegawaiController::class, 'edit']);
    Route::post("/data-pegawai/update", [PegawaiController::class, 'update']);
    Route::post("/data-pegawai/delete", [PegawaiController::class, 'delete']);

    Route::get("/master-jabatan", [JabatanController::class, 'index']);
    Route::post("/master-jabatan/store", [JabatanController::class, 'store']);
    Route::get("/data-jabatan/edit", [JabatanController::class, 'edit']);
    Route::post("/data-jabatan/update", [JabatanController::class, 'update']);
    Route::post("/data-jabatan/delete", [JabatanController::class, 'delete']);
});