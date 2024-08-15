<?php

namespace App\Http\Controllers;

use App\Models\NotulenRapat;
use App\Http\Requests\StoreNotulenRapatRequest;
use App\Http\Requests\UpdateNotulenRapatRequest;
use App\Models\Event;
use App\Models\UnitKerja;
use Carbon\Carbon;

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
}
