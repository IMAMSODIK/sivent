<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdatePesertaRequest;
use App\Models\Event;
use App\Models\Peserta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesertaController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
        ];
        return view('peserta.index', $data);
    }

    public function daftarPeserta(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'pesertas' => Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get()
        ];
        return view('peserta.daftar_peserta', $data);
    }

    public function daftarRegistrasiPeserta(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'pesertas' => Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get()
        ];
        return view('peserta.daftar_registrasi_peserta', $data);
    }

    public function store(Request $r){
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
            'nip' => 'required|string|max:255|unique:pesertas',
            'golongan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bank' => 'required|string',
            'no_rek' => 'required|string|max:255|unique:pesertas',
            'jenis_kelamin' => 'required|string|max:255',
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
                    'is_narsum' => 0
                ]);
    
                if($peserta){
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

    public function registrasi(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
        ];
        return view('peserta.registrasi', $data);
    }
}
