<?php

namespace App\Http\Controllers;

use App\Models\NotulenRapat;
use App\Http\Requests\StoreNotulenRapatRequest;
use App\Http\Requests\UpdateNotulenRapatRequest;
use App\Models\Event;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class NotulenRapatController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'rapat')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'rapat')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Notulen Rapat"
        ];
        return view('notulen_rapat.index', $data);
    }

    public function daftarNotulensi(Request $r){
        $event = Event::where("event_id", $r->kegiatan_id)->first();
        $data = [
            'id_event' => $r->kegiatan_id,
            'laporans' => NotulenRapat::where('event_id', $event->id)->get(),
            'pageTitle' => "Notulensi Rapat"
        ];
        return view('notulen_rapat.daftar_notulensi', $data);
    }

    public function store(Request $r){
        try{
            $event = Event::where('event_id', $r->event_id)->first();

            $template = NotulenRapat::where('event_id', $event->id)->first();
            if($template){
                return response()->json([
                    'status' => false,
                    'message' => "Notulensi Rapat sudah ada"
                ]);
            }else{
                $template = NotulenRapat::create([
                    'deskripsi' => $r->notulensi,
                    'event_id' => $event->id
                ]);

                if($template){
                    return response()->json([
                        'status' => true,
                    ]);    
                }
            }

            return response()->json([
                'status' => false,
                'message' => "Terjadi kesalahan"
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
            $data = NotulenRapat::where('id', $r->id)->first();

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
        try{
            $data = NotulenRapat::where("id", $r->id)->first();

            if($data){
                $data->deskripsi = $r->notulensi;
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
            $data = NotulenRapat::where('id', $r->id)->first();

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
