<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UnitKerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RapatController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::today();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'rapat')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'rapat')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
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
            'no_surat' => $r->no_surat,
            'unit_kerja' => $r->unit_kerja
        ];

        $rules = [
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'no_surat' => 'required|string|max:255|unique:events',
            'unit_kerja' => 'required'
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
                'kategori' => $r->kategori,
                'unit_kerja_id' => $r->unit_kerja,
                'user_id' => Auth::user()->id
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
            if(!($data->user_id == Auth::user()->id)){
                return response()->json([
                    'status' => false,
                    'message' => "Anda tidak dapat memperbaharui Event ini"
                ]);
            }

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
            $event->flayer = $flayer;
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
            'no_surat' => $r->no_surat,
            'unit_kerja' => $r->unit_kerja
        ];

        $rules = [
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'no_surat' => 'required|string|max:255|unique:events,no_surat,'.$event->id,
            'unit_kerja' => 'required'
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
            $event->unit_kerja_id = $r->unit_kerja;
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
            if(!($data->user_id == Auth::user()->id)){
                return response()->json([
                    'status' => false,
                    'message' => "Anda tidak dapat menghapus Event ini"
                ]);
            }

            if($data){
                $data->delete();

                return response()->json([
                    'status' => true,
                    'data' => $data->event_id,
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

    public function filter(Request $r){
        $today = Carbon::today();
        try{
            if($r->kategori){
                $data = Event::where('kategori', $r->kategori);
            }else{
                $data = Event::select('*');
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

            $data = $data->withCount('peserta')->get();

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

    public function checkUser(Request $r){
        try{
            $data = Event::where('event_id', $r->event_id)->first();

            if($data){
                if(!($data->user_id == Auth::user()->id)){
                    return response()->json([
                        'status' => false,
                        'message' => "Anda tidak dapat menambahkan Narasumber Event ini"
                    ]);
                }else{
                    return response()->json([
                        'status' => true
                    ]);
                }
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
