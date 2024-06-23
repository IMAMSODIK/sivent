<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokumentEventRequest;
use App\Http\Requests\UpdateDokumentEventRequest;
use App\Models\DokumentEvent;
use App\Models\Event;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumentEventController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'count_rapat' => Event::where('kategori', 'rapat')->count(),
            'count_meeting' => Event::where('kategori', 'meeting')->count(),
            'count_lembur' => Event::where('kategori', 'lembur')->count(),
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
        ];
        return view('dokumen.index', $data);
    }

    public function daftarDokumen(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'dokumens' => DokumentEvent::where('event_id', $event->id)->get()
        ];
        return view('dokumen.daftar_dokumen', $data);
    }

    // public function daftarRegistrasiPeserta(Request $r){
    //     $event = Event::where("event_id", $r->kegiatan_id)->first();
    //     $data = [
    //         'id_event' => $r->kegiatan_id,
    //         'pesertas' => Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get()
    //     ];
    //     return view('peserta.daftar_registrasi_peserta', $data);
    // }

    public function store(Request $r){
        $dokumen = null;

        if ($r->hasFile('dokumen')) {
            $file = $r->file('dokumen');
            $fileMimeType = $file->getClientMimeType();

            if ($fileMimeType != 'image/png' && $fileMimeType != 'image/jpg' && $fileMimeType != 'image/jpeg') {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung"
                ]);
            }

            $dokumen = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('dokumen', $dokumen, 'public');
        }

        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'unique' => 'Kolom :attribute sudah digunakan.'
        ];

        $data = [
            'event_id' => $r->id_kegiatan,
            'nama' => $r->nama,
            'deskripsi' => $r->deskripsi,
        ];

        $rules = [
            'event_id' => 'required',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $event = Event::where('event_id', $r->id_kegiatan)->first();
            if($event){
                $dokumen = DokumentEvent::create([
                    'event_id' => $event->id,
                    'nama' => $r->nama,
                    'deskripsi' => $r->deskripsi,
                    'file' => $dokumen
                ]);
    
                if($dokumen){
                    return response()->json([
                        'status' => true
                    ]);
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

    // public function registrasi(){
    //     $tanggalSekarang = Carbon::now();

    //     $data = [
    //         'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
    //     ];
    //     return view('peserta.registrasi', $data);
    // }

    // public function daftarEvent(Request $r){
    //     try{
    //         $tanggalSekarang = Carbon::now();
            
    //         $data = Event::where("kategori", $r->kategori)->get();

    //         if($data){
    //             return response()->json([
    //                 'status' => true,
    //                 'data' => $data
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => "Tidak ada kegiatan pada kategori ini"
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }
}
