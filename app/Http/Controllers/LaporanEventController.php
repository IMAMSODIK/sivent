<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaporanEventRequest;
use App\Http\Requests\UpdateLaporanEventRequest;
use App\Models\Event;
use App\Models\LaporanEvent;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanEventController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now()->subDay();

        $data = [
            'count_rapat' => Event::where('kategori', 'rapat')->count(),
            'count_meeting' => Event::where('kategori', 'meeting')->count(),
            'count_lembur' => Event::where('kategori', 'lembur')->count(),
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Laporan Event"
        ];
        return view('laporan.index', $data);
    }

    public function daftarLaporan(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'laporans' => LaporanEvent::where('event_id', $event->id)->get(),
            'pageTitle' => "Daftar Laporan"
        ];
        return view('laporan.daftar_laporan', $data);
    }

    public function store(Request $r){
        $laporan = null;

        if ($r->hasFile('file')) {
            $file = $r->file('file');
            $fileMimeType = $file->getClientMimeType();
            $fileExtension = $file->getClientOriginalExtension();
            $allowedMimeTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $allowedExtensions = ['pdf', 'doc', 'docx'];
        
            if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung. Hanya PDF dan Word (DOC, DOCX) yang diperbolehkan."
                ]);
            }
        
            $laporan = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('laporan', $laporan, 'public');
        }else{
            return response()->json([
                'status' => false,
                'message' => "Dokumen belum diupload"
            ]);
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
                $data = LaporanEvent::create([
                    'event_id' => $event->id,
                    'nama' => $r->nama,
                    'deskripsi' => $r->deskripsi,
                    'file' => $laporan
                ]);
    
                if($data){
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

    public function edit(Request $r){
        try{
            $data = LaporanEvent::where('id', $r->id)->first();

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

    public function update(Request $r){
        $laporan = null;

        if ($r->hasFile('file')) {
            $file = $r->file('file');
            $fileMimeType = $file->getClientMimeType();
            $fileExtension = $file->getClientOriginalExtension();
            $allowedMimeTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $allowedExtensions = ['pdf', 'doc', 'docx'];
        
            if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung. Hanya PDF dan Word (DOC, DOCX) yang diperbolehkan."
                ]);
            }
        
            $laporan = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('laporan', $laporan, 'public');
        }

        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'unique' => 'Kolom :attribute sudah digunakan.'
        ];

        $data = [
            'id' => $r->id,
            'nama' => $r->nama,
            'deskripsi' => $r->deskripsi,
        ];

        $rules = [
            'id' => 'required',
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
            $data = LaporanEvent::where("id", $r->id)->first();

            if($data){
                $data->nama = $r->nama;
                $data->deskripsi = $r->deskripsi;

                if($laporan){
                    $data->file = $laporan;
                }
                
                $data->save();

                return response()->json([
                    'status' => true
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Gagal mengubah data"
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
            $data = LaporanEvent::where('id', $r->id)->first();

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
}
