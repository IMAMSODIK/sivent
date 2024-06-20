<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use App\Models\Peserta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = [
            'pegawai' => Pegawai::all()
        ];
        return view('pegawai.index', $data);
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
            'nama' => $r->nama,
            'nip' => $r->nip,
            'golongan' => $r->golongan,
            'jabatan' => $r->jabatan,
            'jenis_kelamin' => $r->jenis_kelamin,
        ];

        $rules = [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $peserta = Pegawai::create([
                'peserta_id' => Str::random(8),
                'nama' => $r->nama,
                'nip' => $r->nip,
                'golongan' => $r->golongan,
                'jabatan' => $r->jabatan,
                'jenis_kelamin' => $r->jenis_kelamin
            ]);

            if($peserta){
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
