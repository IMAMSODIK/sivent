<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Peserta;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class KitSeminarController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Kit"
        ];
        return view('kit_seminar.index', $data);
    }

    public function daftarKit(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'pesertas' => Peserta::where('event_id', $event->id)->where('is_narsum', 0)->get(),
            'pageTitle' => "Daftar Kit"
        ];
        return view('kit_seminar.daftar_kit_seminar', $data);
    }

    public function update(Request $r){
        try{
            $data = Peserta::where('id', $r->id)->first();

            if($data){
                $data->status_kit = $r->status_kit;
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
}
