<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FotoEvent;
use App\Models\Peserta;
use App\Models\Rundown;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportLaporan(Request $r){
        $event = Event::where('event_id', $r->id)->first();
        $rundown = Rundown::where('event_id', $event->id)->get();
        $peserta = Peserta::with('pegawai')->where('event_id', $event->id)->where('is_narsum', 0)->get();
        $fotos = FotoEvent::where('event_id', $event->id)->get();

        $data = [
            'event' => $event,
            'rundowns' => $rundown,
            'pesertas' => $peserta,
            'fotos' => $fotos
        ];

        if($event->kategori == 'meeting'){
            $data['narasumbers'] = Peserta::where('event_id', $event->id)->where('is_narsum', 1)->get();
        }

        // ini_set('max_execution_time', 480);
        // $pdf = Pdf::loadView('export.lapora_event', $data);
        // return $pdf->download('laporan_event.pdf');

        return view('export.lapora_event', $data);
    }
}
