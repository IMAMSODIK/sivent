<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Peserta;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventPesertaController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now()->subDay();
        $idRapat = Peserta::where('nip', Auth::user()->username)
        ->distinct()
        ->pluck('event_id');

        $countEvents = Event::whereIn('id', $idRapat)
        ->get(['id', 'kategori']);

        $eventsByCategory = $countEvents->groupBy('kategori');


        $data = [
            'count_rapat' => $eventsByCategory->get('rapat', collect())->count(),
            'count_meeting' => $eventsByCategory->get('meeting', collect())->count(),
            'count_lembur' => $eventsByCategory->get('lembur', collect())->count(),
            'event_incoming' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
            'event_done' => Event::whereIn('id', $idRapat)->where('tanggal_kegiatan', '<', $tanggalSekarang)->get(),
        ];
        return view('peserta_page.index', $data);
    }

    public function daftarEvent(Request $r){
        try{
            $tanggalSekarang = Carbon::now();
            $idRapat = Peserta::where('nip', Auth::user()->username)
                        ->distinct()
                        ->pluck('event_id');
            $data = Event::whereIn('id', $idRapat)->where("kategori", $r->kategori)->get();

            if($data){
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Tidak ada kegiatan pada kategori ini"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function filterEvent(Request $r){
        $today = Carbon::today();
        $idRapat = Peserta::where('nip', Auth::user()->username)
                        ->distinct()
                        ->pluck('event_id');
        $data = Event::whereIn('id', $idRapat);
        try{
            if($r->kategori){
                $data = $data->where('kategori', $r->kategori);
            }else{
                $data = $data->select('*');
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

            $data = $data->get();

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