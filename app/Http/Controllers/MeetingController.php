<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::today();

        $data = [
            'event_incoming' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->where('kategori', 'meeting')->get(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
            'pageTitle' => "Meeting",
            'pegawais' => Pegawai::select('id', 'nama', 'nip', 'jabatan')->get()
        ];
        return view('event.meeting', $data);
    }
}
