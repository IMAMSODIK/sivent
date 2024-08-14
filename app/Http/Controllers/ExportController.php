<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FotoEvent;
use App\Models\LaporanEvent;
use App\Models\LaporanTemplate;
use App\Models\Peserta;
use App\Models\Rundown;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportLaporan(Request $r){
        $event = Event::where('event_id', $r->id)->first();
        $rundown = Rundown::where('event_id', $event->id)->get();
        $peserta = Peserta::with('pegawai')->where('event_id', $event->id)->where('is_narsum', 0)->get();
        $fotos = FotoEvent::where('event_id', $event->id)->get();
        $laporan = LaporanTemplate::where('event_id', $event->id)->first();

        $data = [
            'event' => $event,
            'rundowns' => $rundown,
            'pesertas' => $peserta,
            'fotos' => $fotos,
            'laporans' => $laporan
        ];

        if($event->kategori == 'meeting'){
            $data['narasumbers'] = Peserta::where('event_id', $event->id)->where('is_narsum', 1)->get();
        }

        // ini_set('max_execution_time', 480);
        // $pdf = Pdf::loadView('export.lapora_event', $data);
        // return $pdf->download('laporan_event.pdf');

        return view('export.lapora_event', $data);
    }

    public function formatLaporan(Request $r){
        try{
            $event = Event::where('event_id', $r->event_id)->first();

            $template = LaporanTemplate::where('event_id', $event->id)->first();
            if($template){
                $template->laporan = $r->format_laporan;
                $template->save();
            }else{
                $template = LaporanTemplate::create([
                    'laporan' => $r->format_laporan,
                    'event_id' => $event->id
                ]);
            }

            if($template){
                return response()->json([
                    'status' => true,
                    'event_id' => $event->event_id
                ]);    
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

    public function checkExportLaporan(Request $r){
        try{
            $event = Event::where('event_id', $r->event_id)->first();
            $laporan = LaporanTemplate::where('event_id', $event->id)->first();

            if($laporan){
                return response()->json([
                    'status' => true,
                    'data' => $laporan->laporan
                ]);    
            }else{
                return response()->json([
                    'status' => true,
                    'data' => null
                ]);
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
}
