<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $tanggalSekarang = Carbon::now();

        $data = [
            'event' => Event::count(),
            'event_today' => Event::where('tanggal_kegiatan', '=', $tanggalSekarang)->count(),
            'event_incoming' => Event::where('tanggal_kegiatan', '>', $tanggalSekarang)->count(),
            'event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->count(),
        ];

        return view('dashboard.index', $data);
    }
}
