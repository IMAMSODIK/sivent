<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use App\Imports\RundownImport;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importPeserta(Request $r){
        try{
            $r->validate([
                'file' => 'required|mimes:xlsx,xls,csv',
            ]);
    
            $file = $r->file('file');
            $id_event = Event::where('event_id', $r->id_kegiatan)->first();

            if (!$id_event) {
                return redirect()->back()->with('error', 'ID Event tidak ditemukan.');
            }

            $import = new PesertaImport($id_event->id, $id_event->kategori);
    
            Excel::import($import, $file);

            return response()->json([
                'status' => true
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function importRundown(Request $r){
        try{
            $r->validate([
                'file' => 'required|mimes:xlsx,xls,csv',
            ]);
    
            $file = $r->file('file');
            $id_event = Event::where('event_id', $r->id_kegiatan)->value('id');

            if (!$id_event) {
                return redirect()->back()->with('error', 'ID Event tidak ditemukan.');
            }

            $import = new RundownImport($id_event);
    
            Excel::import($import, $file);

            return response()->json([
                'status' => true
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
