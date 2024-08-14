<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\LaporanEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $startOfToday = Carbon::today();
        $endOfToday = Carbon::today()->endOfDay();
        $tanggalSekarang = Carbon::now();
        $tahunSekarang = Carbon::now()->year;

        $eventToday = Event::with('unitKerja')
                        ->withCount('peserta')
                        ->whereBetween('tanggal_kegiatan', [$startOfToday, $endOfToday])
                        ->get();

        $jumlahEventPerBulanRapat = DB::table('events')
                                        ->select(DB::raw('MONTH(tanggal_kegiatan) as bulan'), DB::raw('COUNT(*) as jumlah_event'))
                                        ->whereYear('tanggal_kegiatan', $tahunSekarang)
                                        ->where('kategori', 'rapat')
                                        ->groupBy(DB::raw('MONTH(tanggal_kegiatan)'))
                                        ->orderBy(DB::raw('MONTH(tanggal_kegiatan)'))
                                        ->pluck('jumlah_event', 'bulan');

        $jumlahEventPerBulanMeeting = DB::table('events')
                                        ->select(DB::raw('MONTH(tanggal_kegiatan) as bulan'), DB::raw('COUNT(*) as jumlah_event'))
                                        ->whereYear('tanggal_kegiatan', $tahunSekarang)
                                        ->where('kategori', 'meeting')
                                        ->groupBy(DB::raw('MONTH(tanggal_kegiatan)'))
                                        ->orderBy(DB::raw('MONTH(tanggal_kegiatan)'))
                                        ->pluck('jumlah_event', 'bulan');

        $jumlahEventPerBulanLembur = DB::table('events')
                                        ->select(DB::raw('MONTH(tanggal_kegiatan) as bulan'), DB::raw('COUNT(*) as jumlah_event'))
                                        ->whereYear('tanggal_kegiatan', $tahunSekarang)
                                        ->where('kategori', 'lembur')
                                        ->groupBy(DB::raw('MONTH(tanggal_kegiatan)'))
                                        ->orderBy(DB::raw('MONTH(tanggal_kegiatan)'))
                                        ->pluck('jumlah_event', 'bulan');
                    
        $eventPerBulanArrayRapat = [];
        $eventPerBulanArrayMeeting = [];
        $eventPerBulanArrayLembur = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $eventPerBulanArrayRapat[] = $jumlahEventPerBulanRapat->get($bulan, 0);
            $eventPerBulanArrayMeeting[] = $jumlahEventPerBulanMeeting->get($bulan, 0);
            $eventPerBulanArrayLembur[] = $jumlahEventPerBulanLembur->get($bulan, 0);
        }

        $data = [
            'count_event' => Event::count(),
            'count_event_today' => Event::where('tanggal_kegiatan', '=', $tanggalSekarang)->count(),
            'count_event_incoming' => Event::where('tanggal_kegiatan', '>', $tanggalSekarang)->count(),
            'count_event_done' => Event::where('tanggal_kegiatan', '<', $tanggalSekarang)->count(),
            'event_today' => $eventToday,
            'arrRapat' => $eventPerBulanArrayRapat,
            'arrMeeting' => $eventPerBulanArrayMeeting,
            'arrLembur' => $eventPerBulanArrayLembur,
            'pageTitle' => "Dashboard"
        ];

        return view('dashboard.index', $data);
    }
}
