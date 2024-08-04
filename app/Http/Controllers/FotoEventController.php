<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFotoEventRequest;
use App\Http\Requests\UpdateFotoEventRequest;
use App\Models\Event;
use App\Models\FotoEvent;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FotoEventController extends Controller
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
        return view('foto.index', $data);
    }

    public function daftarFoto(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'fotos' => FotoEvent::where('event_id', $event->id)->get()
        ];
        return view('foto.daftar_foto', $data);
    }

    // public function daftarRegistrasiPeserta(Request $r){
    //     $event = Event::where("event_id", $r->kegiatan_id)->first();
    //     $data = [
    //         'id_event' => $r->kegiatan_id,
    //         'pesertas' => Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get()
    //     ];
    //     return view('peserta.daftar_registrasi_peserta', $data);
    // }

    // public function store(Request $r){
    //     $foto = null;

    //     if ($r->hasFile('foto')) {
    //         $file = $r->file('foto');
    //         $fileMimeType = $file->getClientMimeType();

    //         if ($fileMimeType != 'image/png' && $fileMimeType != 'image/jpg' && $fileMimeType != 'image/jpeg') {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => "Jenis File Tidak Didukung"
    //             ]);
    //         }

    //         $foto = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
    //         $file->storePubliclyAs('foto', $foto, 'public');
    //     }

    //     $messages = [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'numeric' => 'Kolom :attribute harus berupa angka.',
    //         'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
    //         'string' => 'Kolom :attribute harus berupa teks.',
    //         'unique' => 'Kolom :attribute sudah digunakan.'
    //     ];

    //     $data = [
    //         'event_id' => $r->id_kegiatan,
    //         'keterangan' => $r->deskripsi,
    //     ];

    //     $rules = [
    //         'event_id' => 'required',
    //         'keterangan' => 'required|string'
    //     ];

    //     $validator = Validator::make($data, $rules, $messages);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => implode(', ', $validator->errors()->all())
    //         ]);
    //     }

    //     try{
    //         $event = Event::where('event_id', $r->id_kegiatan)->first();
    //         if($event){
    //             $foto = FotoEvent::create([
    //                 'event_id' => $event->id,
    //                 'keterangan' => $r->deskripsi,
    //                 'foto' => $foto
    //             ]);
    
    //             if($foto){
    //                 return response()->json([
    //                     'status' => true
    //                 ]);
    //             }
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => "Gagal menambahkan data"
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    public function store(Request $r)
    {
        // Validasi form input
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'file' => 'Kolom :attribute harus berupa file.',
            'mimes' => 'Jenis file yang diperbolehkan adalah :values.',
            'max' => 'Ukuran file tidak boleh lebih dari :max kilobytes.'
        ];

        $rules = [
            'deskripsi' => 'required|string',
            'foto.*' => 'file|mimes:jpg,jpeg,png|max:2048' // Validasi untuk file gambar
        ];

        $data = $r->only(['deskripsi']);
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try {
            $event = Event::where('event_id', $r->id_kegiatan)->first();

            if ($event) {
                $files = $r->file('foto');
                $uploadedPhotos = [];

                foreach ($files as $file) {
                    // Menghasilkan nama file unik
                    $foto = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
                    // Simpan file
                    $file->storePubliclyAs('foto', $foto, 'public');

                    // Simpan informasi file ke database
                    FotoEvent::create([
                        'event_id' => $event->id,
                        'keterangan' => $r->deskripsi,
                        'foto' => $foto
                    ]);

                    $uploadedPhotos[] = $foto;
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Files successfully uploaded',
                    'files' => $uploadedPhotos
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Event not found"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $r){
        try{
            $data = FotoEvent::where('id', $r->id)->first();

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
        $foto = null;

        if ($r->hasFile('foto')) {
            $file = $r->file('foto');
            $fileMimeType = $file->getClientMimeType();

            if ($fileMimeType != 'image/png' && $fileMimeType != 'image/jpg' && $fileMimeType != 'image/jpeg') {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung"
                ]);
            }

            $foto = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('foto', $foto, 'public');
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
            'keterangan' => $r->keterangan,
        ];

        $rules = [
            'id' => 'required',
            'keterangan' => 'required|string'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $data = FotoEvent::where("id", $r->id)->first();

            if($data){
                $data->keterangan = $r->keterangan;
                if($foto){
                    $data->foto = $foto;
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
            $data = FotoEvent::where('id', $r->id)->first();

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
