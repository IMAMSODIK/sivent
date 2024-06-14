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
            $user = Event::create([
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

            if($user){
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
}
