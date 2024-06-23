<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LemburController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'lembur')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'lembur')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
        ];
        return view('event.lembur', $data);
    }
}
