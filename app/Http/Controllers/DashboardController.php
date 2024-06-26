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
            'count_event' => Event::count(),
            'count_event_today' => Event::where('tanggal_kegiatan', '=', $tanggalSekarang)->count(),
            'count_event_incoming' => Event::where('tanggal_kegiatan', '>', $tanggalSekarang)->count(),
            'count_event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->count(),
            'event_today' => Event::where('tanggal_kegiatan', '>=', $tanggalSekarang)->get(),
        ];

        return view('dashboard.index', $data);
    }
}
