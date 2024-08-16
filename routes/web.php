<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumentEventController;
use App\Http\Controllers\EventPesertaController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FotoEventController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KitSeminarController;
use App\Http\Controllers\KunciKamarController;
use App\Http\Controllers\LaporanEventController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NarasumberController;
use App\Http\Controllers\NotulenRapatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\RundownController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use App\Models\Banner;
use App\Models\Event;
use App\Models\LaporanEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
    $tanggalSekarang = Carbon::now()->subDay();

    $data = [
        'rapat' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'rapat')->get(),
        'meeting' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
        'lembur' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'lembur')->get(),
        'banners' => Banner::all()
    ];
    return view('landing_page', $data);
});

Route::get('/detail', function(Request $r){
    $data = [
        'event' => Event::where('event_id', $r->id)->first()
    ];
    return view('detail_event', $data);
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginCheck']);
});

Route::redirect('/home', '/dashboard');

// Route::get("/absensi-peserta/rapat/front", [PesertaController::class, 'absensiRapatFront']);
// Route::get("/registrasi-peserta/meeting/front", [PesertaController::class, 'registrasiMeetingFront']);
// Route::get("/absensi-peserta/meeting/front", [PesertaController::class, 'absensiMeetingFront']);
// Route::get("/kit-peserta/meeting/front", [PesertaController::class, 'kitMeetingFront']);
// Route::get("/absensi-peserta/lembur/front", [PesertaController::class, 'absensiLemburFront']);
// Route::post("/kit-peserta/daftar-peserta/kit", [PesertaController::class, 'kitAksi']);

// Route::get("/absensi-peserta/rapat/front/daftar-peserta", [PesertaController::class, 'daftarPesertaFront']);
// Route::get("/registrasi-peserta/front", [PesertaController::class, 'registrasiFront']);


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
    Route::get("/data-event/check-user", [RapatController::class, 'checkUser']);

    Route::get("/data-peserta", [PesertaController::class, 'index']);
    Route::get("/data-peserta/daftar-peserta", [PesertaController::class, 'daftarPeserta']);
    Route::get("/data-peserta/select-peserta", [PesertaController::class, 'selectPeserta']);
    Route::post("/data-peserta/daftar-peserta/store", [PesertaController::class, 'store']);
    Route::post("/data-peserta/daftar-peserta/import-peserta", [ImportController::class, 'importPeserta']);
    Route::get("/data-peserta/daftar-peserta/import-peserta/check", [ImportController::class, 'checkAdmin']);
    Route::post("/data-peserta/daftar-peserta/upload-bt", [PesertaController::class, 'uploadBt']);
    Route::post("/data-peserta/daftar-peserta/update", [PesertaController::class, 'update']);
    Route::post("/data-peserta/daftar-peserta/delete", [PesertaController::class, 'delete']);
    Route::get("/data-peserta/daftar-peserta/detail", [PesertaController::class, 'detail']);
    Route::get("/data-peserta/daftar-event", [PesertaController::class, 'daftarEvent']);

    Route::get("/data-narasumber", [NarasumberController::class, 'index']);
    Route::get("/data-narasumber/daftar-narasumber", [NarasumberController::class, 'daftarNarasumber']);
    Route::post("/data-narasumber/daftar-narasumber/store", [NarasumberController::class, 'store']);
    Route::get("/data-narasumber/daftar-narasumber/edit", [NarasumberController::class, 'edit']);
    Route::post("/data-narasumber/daftar-narasumber/update", [NarasumberController::class, 'update']);
    Route::post("/data-narasumber/daftar-narasumber/delete", [NarasumberController::class, 'delete']);

    Route::get("/data-bank", [BankController::class, 'index']);
    Route::post("/data-bank/store", [BankController::class, 'store']);
    Route::get("/data-bank/edit", [BankController::class, 'edit']);
    Route::post("/data-bank/update", [BankController::class, 'update']);
    Route::post("/data-bank/delete", [BankController::class, 'delete']);

    Route::get("/data-rundown", [RundownController::class, 'index']);
    Route::get("/data-rundown/daftar-rundown", [RundownController::class, 'daftarRundown']);
    Route::post("/data-rundown/daftar-rundown/store", [RundownController::class, 'store']);
    Route::post("/data-rundown/daftar-rundown/import-rundown", [ImportController::class, 'importRundown']);
    Route::get("/data-rundown/daftar-rundown/edit", [RundownController::class, 'edit']);
    Route::post("/data-rundown/daftar-rundown/update", [RundownController::class, 'update']);
    Route::post("/data-rundown/daftar-rundown/delete", [RundownController::class, 'delete']);

    Route::get("/document", [DokumentEventController::class, 'index']);
    Route::get("/document/daftar-document", [DokumentEventController::class, 'daftarDokumen']);
    Route::post("/document/daftar-document/store", [DokumentEventController::class, 'store']);
    Route::get("/document/daftar-document/edit", [DokumentEventController::class, 'edit']);
    Route::post("/document/daftar-document/update", [DokumentEventController::class, 'update']);
    Route::post("/document/daftar-document/delete", [DokumentEventController::class, 'delete']);

    Route::get("/laporan-event", [LaporanEventController::class, 'index']);
    Route::get("/laporan-event/daftar-laporan-event", [LaporanEventController::class, 'daftarLaporan']);
    Route::post("/laporan-event/daftar-laporan-event/store", [LaporanEventController::class, 'store']);
    Route::get("/laporan-event/daftar-laporan-event/edit", [LaporanEventController::class, 'edit']);
    Route::post("/laporan-event/daftar-laporan-event/update", [LaporanEventController::class, 'update']);
    Route::post("/laporan-event/daftar-laporan-event/delete", [LaporanEventController::class, 'delete']);

    Route::get("/notulen-rapat", [NotulenRapatController::class, 'index']);
    Route::get("/notulen-rapat/daftar-notulen-rapat", [NotulenRapatController::class, 'daftarNotulensi']);
    Route::post("/notulen-rapat/daftar-notulen-rapat/store", [NotulenRapatController::class, 'store']);
    Route::get("/notulen-rapat/daftar-notulen-rapat/edit", [NotulenRapatController::class, 'edit']);
    Route::post("/notulen-rapat/daftar-notulen-rapat/update", [NotulenRapatController::class, 'update']);
    Route::post("/notulen-rapat/daftar-notulen-rapat/delete", [NotulenRapatController::class, 'delete']);

    Route::get("/foto-event", [FotoEventController::class, 'index']);
    Route::get("/foto-event/daftar-foto", [FotoEventController::class, 'daftarFoto']);
    Route::post("/foto-event/daftar-foto/store", [FotoEventController::class, 'store']);
    Route::get("/foto-event/daftar-foto/edit", [FotoEventController::class, 'edit']);
    Route::post("/foto-event/daftar-foto/update", [FotoEventController::class, 'update']);
    Route::post("/foto-event/daftar-foto/delete", [FotoEventController::class, 'delete']);

    Route::get("/kit-seminar", [KitSeminarController::class, 'index']);
    Route::get("/kit-seminar/daftar-kit", [KitSeminarController::class, 'daftarKit']);
    Route::get("/kit-seminar/daftar-kit/edit", [KitSeminarController::class, 'edit']);
    Route::post("/kit-seminar/daftar-kit/update", [KitSeminarController::class, 'update']);

    Route::get("/data-kamar", [KamarController::class, 'index']);
    Route::get("/data-kamar/daftar-peserta", [KamarController::class, 'daftarPeserta']);
    Route::get("/data-kamar/daftar-peserta/edit", [KamarController::class, 'edit']);
    Route::post("/data-kamar/daftar-peserta/update", [KamarController::class, 'update']);

    Route::get("/kunci-kamar", [KunciKamarController::class, 'index']);
    Route::get("/kunci-kamar/daftar-kamar", [KunciKamarController::class, 'daftarKamar']);
    Route::get("/kunci-kamar/daftar-kamar/peserta", [KunciKamarController::class, 'kunciKamar']);
    Route::get("/kunci-kamar/daftar-kamar/edit", [KunciKamarController::class, 'edit']);
    Route::post("/kunci-kamar/daftar-kamar/update", [KunciKamarController::class, 'update']);
    Route::post("/kunci-kamar/daftar-kamar/store", [KunciKamarController::class, 'store']);
    Route::post("/kunci-kamar/daftar-kamar/delete", [KunciKamarController::class, 'delete']);

    Route::get("/registrasi-peserta", [PesertaController::class, 'registrasi']);
    Route::get("/registrasi-peserta/daftar-peserta", [PesertaController::class, 'daftarRegistrasiPeserta']);
    Route::post("/registrasi-peserta/daftar-peserta/register", [PesertaController::class, 'register']);
    Route::post("/absensi-peserta/daftar-peserta/absensi-admin", [PesertaController::class, 'absensiAct']);
    // Route::post("/registrasi-peserta/daftar-peserta/store", [NarasumberController::class, 'store']);

    Route::get("/data-unit-kerja", [UnitKerjaController::class, 'index']);
    Route::post("/data-unit-kerja/store", [UnitKerjaController::class, 'store']);
    Route::get("/data-unit-kerja/edit", [UnitKerjaController::class, 'edit']);
    Route::post("/data-unit-kerja/update", [UnitKerjaController::class, 'update']);
    Route::post("/data-unit-kerja/delete", [UnitKerjaController::class, 'delete']);

    Route::get("/banner", [BannerController::class, 'index']);
    Route::post("/banner/store", [BannerController::class, 'store']);
    Route::get("/banner/edit", [BannerController::class, 'edit']);
    Route::post("/banner/update", [BannerController::class, 'update']);
    Route::post("/banner/delete", [BannerController::class, 'delete']);

    Route::get("/data-admin", [UserController::class, 'index']);
    Route::post("/data-admin/store", [UserController::class, 'store']);
    Route::get("/data-admin/edit", [UserController::class, 'edit']);
    Route::post("/data-admin/update", [UserController::class, 'update']);
    Route::post("/data-admin/delete", [UserController::class, 'delete']);

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

    Route::get("/absensi-peserta", [PesertaController::class, 'absensi']);
    Route::get("/absensi-peserta/daftar-peserta", [PesertaController::class, 'daftarAbsensiPeserta']);
    Route::get("/absensi-peserta/daftar-peserta/detail", [PesertaController::class, 'detail']);

    Route::get("/profile", [ProfileController::class, 'profile']);

    Route::get("/peserta-page/daftar-event", [EventPesertaController::class, 'index']);
    Route::get("/peserta-page/daftar-event/card", [EventPesertaController::class, 'daftarEvent']);
    Route::get("/peserta-page/daftar-event/filter", [EventPesertaController::class, 'filterEvent']);

    Route::post("/registrasi-peserta/daftar-peserta/registrasi", [PesertaController::class, 'registered']);
    Route::post("/absensi-peserta/daftar-peserta/absensi", [PesertaController::class, 'absensiAksi']);
    Route::post("/seminar-kit-peserta/daftar-peserta/seminar-kit", [PesertaController::class, 'seminarKitAksi']);

    Route::get('/event/export-laporan', [ExportController::class, 'exportLaporan']);
    Route::post('/event/format-laporan/store', [ExportController::class, 'formatLaporan']);
    Route::get('/event/format-laporan/check', [ExportController::class, 'checkExportLaporan']);
    Route::post('/event/format-laporan/ketua-event', [ExportController::class, 'ketuaEvent']);


    //user biasa
    Route::get("/peserta-page/registrasi", [EventPesertaController::class, 'registrasiPage']);
    Route::get("/peserta-page/status-registrasi", [EventPesertaController::class, 'statusRegistrasi']);
    Route::get("/peserta-page/absensi", [EventPesertaController::class, 'absensiPage']);
    Route::post("/absensi-peserta/daftar-peserta/ttd", [EventPesertaController::class, 'ttd']);
    Route::get("/peserta-page/status-absensi", [EventPesertaController::class, 'statusAbsensi']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/storage-link', function () {
    $targetStorage = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetStorage, $linkFolder);
});