<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRundownRequest;
use App\Http\Requests\UpdateRundownRequest;
use App\Models\Rundown;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RundownController extends Controller
{
    public function index(){
        $data = [
            'rundowns' => Rundown::all()
        ];
        return view('rundown.index', $data);
    }

    public function store(Request $r){
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'unique' => 'Kolom :attribute sudah digunakan.'
        ];

        $data = [
            'tanggal_kegiatan' => $r->tanggal_kegiatan,
            'waktu_kegiatan' => $r->waktu_kegiatan,
            'keterangan_kegiatan' => $r->deskripsi_kegiatan,
        ];

        $rules = [
            'tanggal_kegiatan' => 'required|string|max:255',
            'waktu_kegiatan' => 'required|string|max:255',
            'keterangan_kegiatan' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $rundown = Rundown::create($data);

            if($rundown){
                return response()->json([
                    'status' => true
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Gagal menambahkan data"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
