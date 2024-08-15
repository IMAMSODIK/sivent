<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdatePesertaRequest;
use App\Models\Event;
use App\Models\Pegawai;
use App\Models\Peserta;
use App\Models\UnitKerja;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesertaController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::today();

        $data = [
            'count_rapat' => Event::where('kategori', 'rapat')->count(),
            'count_meeting' => Event::where('kategori', 'meeting')->count(),
            'count_lembur' => Event::where('kategori', 'lembur')->count(),
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->withCount('peserta')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->withCount('peserta')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Data Peserta"
        ];
        return view('peserta.index', $data);
    }
    
    public function daftarPesertaFront(Request $r){
        try{
            $event = Event::where("id", $r->id)->first();
            if($event){
                if($event->kategori == "rapat" || $event->kategori == "lembur"){
                    $peserta = Peserta::with('pegawai')->where('event_id', $event->id)->get();
                }else{
                    $peserta = Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get();
                }

                return response()->json([
                    'status' => true,
                    'data' => $peserta
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => "Data tidak ditemukan"
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function daftarPeserta(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();

        if($event->kategori == "rapat" || $event->kategori == "lembur"){
            $peserta = Peserta::with('pegawai')->where('event_id', $event->id)->get();
        }else{
            $peserta = Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get();
        }
        $data = [
            'id_event' => $r->kegiatan_id,
            'kategori_event' => $event->kategori,
            'pesertas' => $peserta,
            'pageTitle' => "Daftar Peserta"
        ];
        return view('peserta.daftar_peserta', $data);
    }

    public function daftarRegistrasiPeserta(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'pesertas' => Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get(),
            'pageTitle' => 'Registrasi Peserta'
        ];
        return view('peserta.daftar_registrasi_peserta', $data);
    }

    public function store(Request $r){
        try{
            $event = Event::where('event_id', $r->id_kegiatan)->first();
            $status_registrasi = ($event->kategori == 'meeting') ? 0 : 1;
            
            if($event){
                if($r->tipe == 'select'){
                    foreach(explode(",", $r->selected_id) as $id){
                        Peserta::create([
                            'peserta_id' => Str::random(8),
                            'pegawai_id' => $id,
                            'event_id' => $event->id,
                            'is_narsum' => 0,
                            'status_registrasi' => $status_registrasi
                        ]);

                        $pegawai = Pegawai::where('id', $id)->first();
                        $user = User::where("username", $pegawai->nip)->first();

                        if(!$user){
                            User::create([
                                'name' => $pegawai->nama,
                                'username' => $pegawai->nip,
                                'password' => bcrypt($pegawai->nip),
                                'role' => 'peserta'
                            ]);
                        }
                    }

                    return response()->json([
                        'status' => true
                    ]);
                }elseif($r->tipe == 'tambah'){
                    $messages = [
                        'required' => 'Kolom :attribute harus diisi.',
                        'numeric' => 'Kolom :attribute harus berupa angka.',
                        'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
                        'string' => 'Kolom :attribute harus berupa teks.',
                        'unique' => 'Kolom :attribute sudah digunakan.'
                    ];
            
                    $data = [
                        'nama' => $r->nama,
                        'nip' => $r->nip,
                        'golongan' => $r->golongan,
                        'jabatan' => $r->jabatan,
                        'bank' => $r->bank,
                        'no_rek' => $r->no_rek,
                        'jenis_kelamin' => $r->jenis_kelamin,
                    ];
            
                    $rules = [
                        'nama' => 'required|string|max:255',
                        'nip' => 'required|string|max:255',
                        'golongan' => 'required|string|max:255',
                        'jabatan' => 'required|string|max:255',
                        'bank' => 'required|string',
                        'no_rek' => 'required|string|max:255',
                        'jenis_kelamin' => 'required|string|max:255',
                    ];
            
                    $validator = Validator::make($data, $rules, $messages);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'status' => false,
                            'message' => implode(', ', $validator->errors()->all())
                        ]);
                    }

                    $peserta = Peserta::create([
                        'peserta_id' => Str::random(8),
                        'event_id' => $event->id,
                        'nama' => $r->nama,
                        'nip' => $r->nip,
                        'golongan' => $r->golongan,
                        'jabatan' => $r->jabatan,
                        'bank' => $r->bank,
                        'no_rek' => $r->no_rek,
                        'jenis_kelamin' => $r->jenis_kelamin,
                        'is_narsum' => 0,
                        'status_registrasi' => $status_registrasi
                    ]);

                    $user = User::where("username", $r->nip)->first();

                    if(!$user){
                        User::create([
                            'name' => $r->nama,
                            'username' => $r->nip,
                            'password' => bcrypt($r->nip),
                            'role' => 'peserta'
                        ]);
                    }
        
                    if($peserta){
                        return response()->json([
                            'status' => true
                        ]);
                    }
                }
            }

            return response()->json([
                'status' => false,
                'message' => "Gagal menambahkan data"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $r){
        try{
            $messages = [
                'required' => 'Kolom :attribute harus diisi.',
                'numeric' => 'Kolom :attribute harus berupa angka.',
                'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
                'string' => 'Kolom :attribute harus berupa teks.',
                'unique' => 'Kolom :attribute sudah digunakan.'
            ];
    
            $data = [
                'nama' => $r->nama,
                'nip' => $r->nip,
                'golongan' => $r->golongan,
                'jabatan' => $r->jabatan,
                'bank' => $r->bank,
                'no_rek' => $r->no_rek,
                'jenis_kelamin' => $r->jenis_kelamin,
            ];
    
            $rules = [
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:255',
                'golongan' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'bank' => 'required|string',
                'no_rek' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|max:255',
            ];
    
            $validator = Validator::make($data, $rules, $messages);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => implode(', ', $validator->errors()->all())
                ]);
            }

            $peserta = Peserta::where('id', $r->id)->first();
            
            if($peserta){
                $peserta->nama = $r->nama;
                $peserta->nip = $r->nip;
                $peserta->golongan = $r->golongan;
                $peserta->jabatan = $r->jabatan;
                $peserta->bank = $r->bank;
                $peserta->no_rek = $r->no_rek;
                $peserta->jenis_kelamin = $r->jenis_kelamin;
                $peserta->save();

                return response()->json([
                    'status' => true
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Gagal menambahkan data"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function registrasi(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Registrasi Peserta"
        ];
        return view('peserta.registrasi', $data);
    }

    public function selectPeserta(Request $r){
        try{
            $event = Event::where('event_id', $r->id_kegiatan)->first();

            if(!($event->user_id == Auth::user()->id)){
                return response()->json([
                    'status' => false,
                    'message' => "Anda tidak dapat menambahkan peserta Event ini"
                ]);
            }

            $peserta = Peserta::where('event_id', $event->id)->where('pegawai_id', '!=', null)->pluck('pegawai_id');
            $data = Pegawai::whereNotIn('id', $peserta)->get();

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

    public function daftarEvent(Request $r){
        try{
            $tanggalSekarang = Carbon::now();
            
            $data = Event::where("kategori", $r->kategori)->withCount('peserta')->get();

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

    public function detail(Request $r){
        try{
            $event = Event::where('id', $r->id_kegiatan)->first();
            if(!($event->user_id == Auth::user()->id)){
                return response()->json([
                    'status' => false,
                    'message' => "Anda tidak dapat memperbaharui peserta Event ini"
                ]);
            }

            if($event->kategori == 'rapat' || $event->kategori == 'lembur'){
                $data = Peserta::with('pegawai')->where('id', $r->id)->first();
            }else{
                $data = Peserta::where('id', $r->id)->first();
            }

            if($data){
                return response()->json([
                    'status' => true,
                    'kategori_event' => $event->kategori,
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

    public function register(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();

            if($data){
                $data->status_registrasi = 1;
                $data->tanggal_registrasi = $r->tanggal;
                $data->save();

                return response()->json([
                    'status' => true,
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

    public function registered(Request $r){
        try{
            $data = Peserta::where('nip', Auth::user()->username)->where('event_id', $r->event_id)->first();

            if($data){
                $data->status_registrasi = 1;
                $data->save();

                return response()->json([
                    'status' => true,
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

    public function absensi(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'count_rapat' => Event::where('kategori', 'rapat')->count(),
            'count_meeting' => Event::where('kategori', 'meeting')->count(),
            'count_lembur' => Event::where('kategori', 'lembur')->count(),
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Absensi Peserta"
        ];
        return view('peserta.absensi', $data);
    }

    public function absensiAct(Request $r){
        try{
            $status_absensi = 1; // Contoh nilai status_absensi
            $peserta_id = $r->id;
            $newDate = null;
            $newTime = null;
            
            if($r->date){
                $newTime = $r->date;
                $newDate = $r->date;
            }else{
                $newTime = Carbon::now(); // Mendapatkan waktu saat ini
                $newDate = $newTime->format('Y-m-d'); // Mengambil tanggal dari waktu saat ini
            }

            // Periksa jika ada entri dengan tanggal dan peserta yang sama
            $existing = DB::table('absensis')
                ->whereRaw('DATE(time) = ?', [$newDate])
                ->where('peserta_id', $peserta_id)
                ->orderBy('time', 'desc')
                ->first();

            if ($existing) {
                // // Jika ada, perbarui entri dengan waktu yang lebih baru
                // DB::table('absensis')
                //     ->where('id', $existing->id) // Menggunakan ID dari entri yang ada
                //     ->update(['status_absensi' => $status_absensi, 'time' => $newTime]);
                return response()->json([
                    'status' => false,
                    'message' => "Anda sudah mengisi absensi hari ini"
                ]);
            } else {
                // Jika tidak ada, sisipkan data baru
                DB::table('absensis')
                    ->insert(['status_absensi' => $status_absensi, 'time' => $newTime, 'peserta_id' => $peserta_id]);
            }

            return response()->json([
                'status' => true,
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function daftarAbsensiPeserta(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'pesertas' => Peserta::with('absensi')->where('event_id', $event->id)->where('is_narsum', 0)->get(),
            'pageTitle' => "Absensi Peserta"
        ];
        return view('peserta.daftar_absensi_peserta', $data);
    }

    public function kitAksi(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();
            if(!$data->status_registrasi){
                return response()->json([
                    'status' => false,
                    'message' => "Silahkan Registrasi terlebih dahulu!"
                ]);
            }

            if($data){
                $data->status_kit = $r->status_kit;
                $data->save();

                return response()->json([
                    'status' => true,
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

    public function absensiAksi(Request $r){
        try{
            $data = Peserta::where('nip', Auth::user()->username)->where('event_id', $r->event_id)->first();
            if(!$data->status_registrasi){
                return response()->json([
                    'status' => false,
                    'message' => "Silahkan Registrasi terlebih dahulu!"
                ]);
            }

            if($data){
                $data->status_absensi = "Hadir";
                $data->save();

                return response()->json([
                    'status' => true,
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

    public function seminarKitAksi(Request $r){
        try{
            $data = Peserta::where('nip', Auth::user()->username)->where('event_id', $r->event_id)->first();
            if(!$data->status_registrasi){
                return response()->json([
                    'status' => false,
                    'message' => "Silahkan Registrasi terlebih dahulu!"
                ]);
            }

            if($data){
                $data->status_kit = 1;
                $data->save();

                return response()->json([
                    'status' => true,
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

    public function absensiRapatFront(){
        $tanggalSekarang = Carbon::now()->subDay();

        $data = [
            'rapat' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'rapat')->withCount('peserta')->get(),
        ];
        return view('front.rapat_absensi', $data);
    }

    public function absensiLemburFront(){
        $tanggalSekarang = Carbon::now()->subDay();

        $data = [
            'lembur' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'lembur')->withCount('peserta')->get(),
        ];
        return view('front.lembur_absensi', $data);
    }

    public function registrasiMeetingFront(){
        $tanggalSekarang = Carbon::now()->subDay();

        $data = [
            'meeting' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->withCount('peserta')->get(),
        ];
        return view('front.meeting_registrasi', $data);
    }

    public function kitMeetingFront(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'meeting' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->withCount('peserta')->get(),
        ];
        return view('front.kit', $data);
    }

    public function absensiMeetingFront(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'meeting' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->withCount('peserta')->get(),
        ];
        return view('front.meeting_absensi', $data);
    }

    public function registrasiFront(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'meeting' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->withCount('peserta')->get(),
        ];
        return view('front.registrasi', $data);
    }

    public function absensiFrontDaftarPeserta(Request $r){
        try{
            $data = Peserta::where('event_id', $r->id)->get();

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

    public function delete(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();
            $event = Event::where('id', $data->event_id)->select('user_id')->first();

            if(!($event->user_id == Auth::user()->id)){
                return response()->json([
                    'status' => false,
                    'message' => "Anda tidak dapat menghapus peserta Event ini"
                ]);
            }

            if($data){
                $data->delete();

                return response()->json([
                    'status' => true
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

    public function uploadBt(Request $r){
        $dokumen = null;

        if ($r->hasFile('dokumen')) {
            $file = $r->file('dokumen');
            $fileMimeType = $file->getClientMimeType();
            $fileExtension = $file->getClientOriginalExtension();
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        
            if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung. Hanya gambar JPEG, PNG, dan GIF yang diperbolehkan."
                ]);
            }
        
            $dokumen = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('bukti_transfer', $dokumen, 'public');
        
            $peserta = Peserta::where('id', $r->id)->first();
            $peserta->bukti_transfer = $dokumen;
            $peserta->save();

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Dokumen belum diupload"
            ]);
        }
        
    }
}
