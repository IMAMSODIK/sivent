<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Kamar;
use App\Models\Peserta;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class KunciKamarController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Kunci Kamar"
        ];
        return view('kunci_kamar.index', $data);
    }

    public function daftarKamar(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'kamars' => Peserta::with('pegawai')->where('event_id', $event->id)->get(),
            'pageTitle' => "Daftar Kunci Kamar"
        ];
        return view('kunci_kamar.daftar_kamar', $data);
    }

    public function kunciKamar(Request $r){
        try{
            $event = Event::where("event_id", $r->id_event)->first();
            $data = Peserta::with('pegawai')
                        ->where('event_id', $event->id)
                        ->where('no_kamar', 0)
                        ->get();

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

    public function store(Request $r){
        $event = Event::where('event_id', $r->id_event)->first();
        try{
            $kamar = Kamar::create([
                'event_id' => $event->id,
                'no_kamar' => $r->no_kamar
            ]);

            $peserta = Peserta::where('id', $r->pemegang_id)->first();
            $peserta->no_kamar = $r->no_kamar;
            $peserta->save();

            return response()->json([
                'status' => true,
            ]);   

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
        try{
            $event = Event::where('event_id', $r->id_event)->first();
            $data = Kamar::where('event_id', $event->id)
                        ->where('no_kamar', $r->nomor_kamar)
                        ->first();

            if($data){
                $data->pemegang = $r->nama_peserta;
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

    public function edit(Request $r){
        try{
            $data = Peserta::with('pegawai')->where('id', $r->id)->first();

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

            if($data){
                $data->no_kamar = 0;
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
}
