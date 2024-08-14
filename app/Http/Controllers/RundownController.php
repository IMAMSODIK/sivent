<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRundownRequest;
use App\Http\Requests\UpdateRundownRequest;
use App\Models\Event;
use App\Models\Rundown;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RundownController extends Controller
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
            'pageTitle' => "Rundown"
        ];
        return view('rundown.index', $data);
    }

    public function daftarRundown(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'rundown' => Rundown::where('event_id', $event->id)->get(),
            'pageTitle' => "Daftar Rundown"
        ];
        return view('rundown.daftar_rundown', $data);
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
            'event_id' => $r->id_kegiatan,
            'tanggal_kegiatan' => $r->tanggal_kegiatan,
            'waktu_kegiatan' => $r->waktu_kegiatan,
            'keterangan_kegiatan' => $r->keterangan,
            'aktor' => $r->aktor,
        ];

        $rules = [
            'event_id' => 'required',
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'keterangan_kegiatan' => 'required|string|max:255',
            'aktor' => 'required|string|max:255',
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
            $data['event_id'] = $event->id;
            $rundown = Rundown::create($data);

            if($rundown){
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

    public function edit(Request $r){
        try{
            $data = Rundown::where('id', $r->id)->first();

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
            'tanggal_kegiatan' => $r->tanggal_kegiatan,
            'waktu_kegiatan' => $r->waktu_kegiatan,
            'keterangan_kegiatan' => $r->keterangan,
            'aktor' => $r->aktor,
        ];

        $rules = [
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'keterangan_kegiatan' => 'required|string|max:255',
            'aktor' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $data = Rundown::where("id", $r->id)->first();

            if($data){
                $data->tanggal_kegiatan = $r->tanggal_kegiatan;
                $data->waktu_kegiatan = $r->waktu_kegiatan;
                $data->keterangan_kegiatan = $r->keterangan;
                $data->aktor = $r->aktor;
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
            $data = Rundown::where('id', $r->id)->first();

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
