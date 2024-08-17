<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Event;
use App\Models\Peserta;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventPesertaController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now()->subDay();
        $nip = Auth::user()->username;

        $idRapat = Peserta::where('nip', $nip)
            ->distinct()
            ->pluck('event_id');

        if ($idRapat->isEmpty()) {
            $idRapat = Peserta::whereHas('pegawai', function ($query) use ($nip) {
                $query->where('nip', $nip);
            })
            ->distinct()
            ->pluck('event_id');
        }

        $countEvents = Event::whereIn('id', $idRapat)
        ->get(['id', 'kategori']);

        $eventsByCategory = $countEvents->groupBy('kategori');

        $data = [
            'count_rapat' => $eventsByCategory->get('rapat', collect())->count(),
            'count_meeting' => $eventsByCategory->get('meeting', collect())->count(),
            'count_lembur' => $eventsByCategory->get('lembur', collect())->count(),
            'event_incoming' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
            'event_done' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '<', $tanggalSekarang)->get(),
            'pageTitle' => "Daftar Event"
        ];
        return view('peserta_page.index', $data);
    }

    public function daftarEvent(Request $r){
        try{
            $tanggalSekarang = Carbon::now();
            $idRapat = Peserta::where('nip', Auth::user()->username)
                        ->distinct()
                        ->pluck('event_id');
            $data = Event::whereIn('id', $idRapat)->where("kategori", $r->kategori)->get();

            if($data){
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Tidak ada kegiatan pada kategori ini"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function filterEvent(Request $r){
        $today = Carbon::today();
        $idRapat = Peserta::where('nip', Auth::user()->username)
                        ->distinct()
                        ->pluck('event_id');
        $data = Event::whereIn('id', $idRapat);
        try{
            if($r->kategori){
                $data = $data->where('kategori', $r->kategori);
            }else{
                $data = $data->select('*');
            }

            if($r->unit_kerja){
                $data = $data->whereIn('unit_kerja_id', $r->unit_kerja);
            }
            if($r->status_event){
                switch($r->status_event){
                    case "1":
                        $data = $data->where('tanggal_kegiatan', $today);
                        break;
                    case "2":
                        $data = $data->where('tanggal_kegiatan', '>', $today);
                        break;
                    case "3":
                        $data = $data->where('tanggal_kegiatan', '<', $today);
                        break;
                }
            }

            $data = $data->get();

            if($data){
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function registrasiPage(Request $r){
        $tanggalSekarang = Carbon::now()->subDay();
        $nip = Auth::user()->username;

        $idRapat = Peserta::where('nip', $nip)
            ->distinct()
            ->pluck('event_id');

        if ($idRapat->isEmpty()) {
            $idRapat = Peserta::whereHas('pegawai', function ($query) use ($nip) {
                $query->where('nip', $nip);
            })
            ->distinct()
            ->pluck('event_id');
        }

        $countEvents = Event::whereIn('id', $idRapat)
        ->get(['id', 'kategori']);

        $data = [
            'event_incoming' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'pageTitle' => "Registrasi Event"
        ];
        return view('peserta_page.registrasi_page', $data);
    }

    public function statusRegistrasi(Request $r){
        $event = Event::where('event_id', $r->kegiatan_id)->first();
        $nip = Auth::user()->username;

        $peserta = Peserta::with('absensi')->where('event_id', $event->id)
                        ->where('nip', $nip)
                        ->first();

        if(empty($peserta->nama)){
            $peserta = Peserta::where('event_id', $event->id)
                ->whereHas('pegawai', function ($query) use ($nip) {
                    $query->where('nip', $nip);
                })
                ->with('pegawai')
                ->first();
        }

        $data = [
            'id_event' => $event->event_id,
            'pageTitle' => "Status Registrasi",
            'pesertas' => $peserta
        ];

        return view('peserta_page.daftar_registrasi_peserta', $data);
    }

    public function statusAbsensi(Request $r){
        $event = Event::where('event_id', $r->kegiatan_id)->first();
        $nip = Auth::user()->username;

        $peserta = Peserta::with('absensi')->where('event_id', $event->id)
                        ->where('nip', $nip)
                        ->first();

        if(empty($peserta->nama)){
            $peserta = Peserta::where('event_id', $event->id)
                ->whereHas('pegawai', function ($query) use ($nip) {
                    $query->where('nip', $nip);
                })
                ->with(['pegawai', 'absensi'])
                ->first();
        }

        $data = [
            'id_event' => $event->event_id,
            'pageTitle' => "Status Registrasi",
            'pesertas' => $peserta,
            'absensi' => Absensi::where('peserta_id', $peserta->id)->get()
        ];

        return view('peserta_page.daftar_absensi_peserta', $data);
    }

    public function checkAbsensi(Request $r){
        $peserta = Peserta::with(['event', 'pegawai'])->where('id', $r->id)->first();
        
        if($peserta->event->kategori == 'meeting'){
            if($peserta->status_registrasi == 0){
                return response()->json([
                    'status' => 0,
                    'message' => 'Silahkan registrasi terlebih dahulu',
                ]);
            }
        }

        if(!is_null($peserta->ttd_absensi)){
            return response()->json([
                'status' => 2
            ]);
        }

        return response()->json([
            'status' => 1
        ]);
    }

    public function absensiPage(Request $r){
        $tanggalSekarang = Carbon::now()->subDay();
        $nip = Auth::user()->username;

        $idRapat = Peserta::where('nip', $nip)
            ->distinct()
            ->pluck('event_id');

        if ($idRapat->isEmpty()) {
            $idRapat = Peserta::whereHas('pegawai', function ($query) use ($nip) {
                $query->where('nip', $nip);
            })
            ->distinct()
            ->pluck('event_id');
        }

        $countEvents = Event::whereIn('id', $idRapat)
        ->get(['id', 'kategori']);

        $eventsByCategory = $countEvents->groupBy('kategori');

        $data = [
            'count_rapat' => $eventsByCategory->get('rapat', collect())->count(),
            'count_meeting' => $eventsByCategory->get('meeting', collect())->count(),
            'count_lembur' => $eventsByCategory->get('lembur', collect())->count(),
            'event_incoming' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
            'event_done' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '<', $tanggalSekarang)->get(),
            'pageTitle' => "Daftar Event"
        ];
        return view('peserta_page.absensi_page', $data);
    }

    public function ttd(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();
            if ($r->signature) {
                $signature = $r->signature;
                $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
                $filename = Str::random(8) . '.png';
    
                // Pastikan folder ada atau buat folder
                $folderPath = 'tanda_tangan';
                if (!Storage::disk('public')->exists($folderPath)) {
                    Storage::disk('public')->makeDirectory($folderPath);
                }
    
                Storage::disk('public')->put($folderPath . '/' . $filename, $decodedData);

                $data->ttd_registrasi = $filename;
                $data->status_registrasi = 1;
                $data->save();

                return response()->json([
                    'status' => true
                ]);
            }
    
            return response()->json([
                'status' => 0,
                'message' => 'Silahkan tanda tangan terlebih dahulu',
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 0,
                'message' => 'an erro occured : ' . $e->getMessage(),
            ]);
        }
    }

    public function ttdAbsensi(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();
            if ($r->signature) {
                $signature = $r->signature;
                $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signature));
                $filename = Str::random(8) . '.png';
    
                // Pastikan folder ada atau buat folder
                $folderPath = 'tanda_tangan_absensi';
                if (!Storage::disk('public')->exists($folderPath)) {
                    Storage::disk('public')->makeDirectory($folderPath);
                }
    
                Storage::disk('public')->put($folderPath . '/' . $filename, $decodedData);
                $data->ttd_absensi = $filename;
            }

            $newTime = Carbon::now(); // Mendapatkan waktu saat ini
            $newDate = $newTime->format('Y-m-d'); // Mengambil tanggal dari waktu saat ini

            $existing = DB::table('absensis')
                ->whereRaw('DATE(time) = ?', [$newDate])
                ->where('peserta_id', $data->id)
                ->orderBy('time', 'desc')
                ->first();

            if ($existing) {
                // // Jika ada, perbarui entri dengan waktu yang lebih baru
                // DB::table('absensis')
                //     ->where('id', $existing->id) // Menggunakan ID dari entri yang ada
                //     ->update(['status_absensi' => $status_absensi, 'time' => $newTime]);
                return response()->json([
                    'status' => false,
                    'message' => "Anda sudah mengisi absensi pada tanggal yang sama"
                ]);
            } else {
                // Jika tidak ada, sisipkan data baru
                DB::table('absensis')
                    ->insert(['status_absensi' => 1, 'time' => $newTime, 'peserta_id' => $data->id]);
            }

            $data->save();

            return response()->json([
                'status' => true
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 0,
                'message' => 'an erro occured : ' . $e->getMessage(),
            ]);
        }
    }
}