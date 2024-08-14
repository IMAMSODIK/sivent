<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Kamar;
use App\Models\Peserta;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Kamar"
        ];
        return view('kamar.index', $data);
    }

    public function daftarPeserta(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'pesertas' => Kamar::where('event_id', $event->id)->get(),
            'pageTitle' => "Kunci Kamar"
        ];
        return view('kamar.daftar_kamar', $data);
    }

    public function update(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();

            if($data){
                $data->no_kamar = $r->nomor_kamar;
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
            $event = Event::where('event_id', $r->event)->first();
            $peserta = Peserta::with('pegawai')->where('event_id', $event->id)->get();

            if($peserta){
                return response()->json([
                    'status' => true,
                    'peserta' => $peserta
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
