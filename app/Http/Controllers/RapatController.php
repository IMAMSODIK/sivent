<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RapatController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'rapat')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'rapat')->get(),
        ];
        return view('event.rapat', $data);
    }

    public function store(Request $r){
        $flayer = null;

        if ($r->hasFile('flayer')) {
            $file = $r->file('flayer');
            $fileMimeType = $file->getClientMimeType();

            if ($fileMimeType != 'image/png' && $fileMimeType != 'image/jpg' && $fileMimeType != 'image/jpeg') {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung"
                ]);
            }

            $flayer = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('flayer', $flayer, 'public');
        }
        
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'unique' => 'Kolom :attribute sudah digunakan.'
        ];

        $data = [
            'nama_kegiatan' => $r->nama_kegiatan,
            'lokasi_kegiatan' => $r->lokasi_kegiatan,
            'tanggal_kegiatan' => $r->tanggal_kegiatan,
            'waktu_kegiatan' => $r->waktu_kegiatan,
            'deskripsi_kegiatan' => $r->deskripsi_kegiatan,
            'no_surat' => $r->no_surat
        ];

        $rules = [
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'no_surat' => 'required|string|max:255|unique:events',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $rapat = Event::create([
                'event_id' => Str::random(8),
                'nama_kegiatan' => $r->nama_kegiatan,
                'lokasi_kegiatan' => $r->lokasi_kegiatan,
                'tanggal_kegiatan' => $r->tanggal_kegiatan,
                'waktu_kegiatan' => $r->waktu_kegiatan,
                'deskripsi_kegiatan' => $r->deskripsi_kegiatan,
                'no_surat' => $r->no_surat,
                'flayer' => $flayer,
                'kategori' => $r->kategori
            ]);

            if($rapat){
                return response()->json([
                    'status' => true,
                    'data' => $rapat
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

    public function edit(Request $r){
        try{
            $data = Event::where('event_id', $r->id)->first();

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
        $flayer = null;
        $event = null;

        try{
            $event = Event::where("event_id", $r->id_event)->first();
            if(!$event){
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

        if ($r->hasFile('flayer')) {
            $file = $r->file('flayer');
            $fileMimeType = $file->getClientMimeType();

            if ($fileMimeType != 'image/png' && $fileMimeType != 'image/jpg' && $fileMimeType != 'image/jpeg') {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung"
                ]);
            }

            $flayer = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('flayer', $flayer, 'public');
        }
        
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'unique' => 'Kolom :attribute sudah digunakan.'
        ];

        $data = [
            'nama_kegiatan' => $r->nama_kegiatan,
            'lokasi_kegiatan' => $r->lokasi_kegiatan,
            'tanggal_kegiatan' => $r->tanggal_kegiatan,
            'waktu_kegiatan' => $r->waktu_kegiatan,
            'deskripsi_kegiatan' => $r->deskripsi_kegiatan,
            'no_surat' => $r->no_surat
        ];

        $rules = [
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'no_surat' => 'required|string|max:255|unique:events,no_surat,'.$event->id,
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $event->nama_kegiatan = $r->nama_kegiatan;
            $event->lokasi_kegiatan = $r->lokasi_kegiatan;
            $event->tanggal_kegiatan = $r->tanggal_kegiatan;
            $event->waktu_kegiatan = $r->waktu_kegiatan;
            $event->deskripsi_kegiatan = $r->deskripsi_kegiatan;
            $event->no_surat = $r->no_surat;
            $event->kategori = $r->kategori;
            $event->flayer = $flayer;
            $event->save();

            if($event){
                return response()->json([
                    'status' => true,
                    'data' => $event
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

    public function delete(Request $r){
        try{
            $data = Event::where('event_id', $r->id)->first();
            if($data){
                $data->delete();

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
}
