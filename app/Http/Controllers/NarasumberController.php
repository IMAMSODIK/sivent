<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNarasumberRequest;
use App\Http\Requests\UpdateNarasumberRequest;
use App\Models\Bank;
use App\Models\Event;
use App\Models\Jabatan;
use App\Models\Narasumber;
use App\Models\Peserta;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NarasumberController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now()->subDay();

        $data = [
            // 'count_rapat' => Event::where('kategori', 'rapat')->count(),
            // 'count_meeting' => Event::where('kategori', 'meeting')->count(),
            // 'count_lembur' => Event::where('kategori', 'lembur')->count(),
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
        ];
        return view('narasumber.index', $data);
    }

    public function daftarNarasumber(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'narasumbers' => Peserta::where('event_id', $event->id)->where('is_narsum', 1)->get(),
            'jabatan' => Jabatan::all(),
            'bank' => Bank::all(),
        ];
        return view('narasumber.daftar_narasumber', $data);
    }

    public function store(Request $r){
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.',
        ];

        $data = [
            'nama' => $r->nama,
            'nip' => $r->nip,
            'asal_instansi' => $r->asal_instansi,
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
            'asal_instansi' => 'string|max:255',
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
                $narasumber = Peserta::create([
                    'peserta_id' => Str::random(8),
                    'event_id' => $event->id,
                    'nama' => $r->nama,
                    'nip' => $r->nip,
                    'golongan' => $r->golongan,
                    'jabatan' => $r->jabatan,
                    'bank' => $r->bank,
                    'no_rek' => $r->no_rek,
                    'jenis_kelamin' => $r->jenis_kelamin,
                    'is_narsum' => 1,
                    'asal_instansi' => $r->asal_instansi
                ]);
    
                if($narasumber){
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
            $data = Peserta::where('id', $r->id)->first();
            // $event = Event::where('id', $data->event_id)->select('id')->first();

            // if(!($event->user_id == Auth::user()->id)){
            //     return response()->json([
            //         'status' => false,
            //         'message' => "Anda tidak dapat memperbaharui Narasumber Event ini"
            //     ]);
            // }

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
            'asal_instansi' => $r->asal_instansi,
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
            'asal_instansi' => 'string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $data = Peserta::where("id", $r->id)->first();

            if($data){
                $data->nama = $r->nama;
                $data->nip = $r->nip;
                $data->asal_instansi = $r->asal_instansi;
                $data->golongan = $r->golongan;
                $data->jabatan = $r->jabatan;
                $data->bank = $r->bank;
                $data->no_rek = $r->no_rek;
                $data->jenis_kelamin = $r->jenis_kelamin;
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
            $data = Peserta::where('id', $r->id)->first();

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
