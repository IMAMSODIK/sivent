<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Jabatan;
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
            'pegawai' => Pegawai::with(['jabatan' => function($query){
                $query->select('id', 'nama_jabatan');
            }])->get(),
            'jabatan' => Jabatan::select('id', 'nama_jabatan')->get()
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
            'golongan' => 'required|string|max:10',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required|string|max:20',
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

    public function edit(Request $r){
        try{
            $data = Pegawai::where('id', $r->id)->first();

            if($data){
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);    
            }

            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $r){
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
            'golongan' => 'required|string|max:10',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required|string|max:20',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $data = Pegawai::where("id", $r->id)->first();

            if($data){
                $data->nama = $r->nama;
                $data->nip = $r->nip;
                $data->golongan = $r->golongan;
                $data->jabatan_id = $r->jabatan;
                $data->jenis_kelamin = $r->jenis_kelamin;
                $data->save();

                return response()->json([
                    'status' => true
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => "Gagal mengubah data"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $r){
        try{
            $data = Pegawai::where('id', $r->id)->first();

            if($data){
                $data->delete();

                return response()->json([
                    'status' => true
                ]);   
            }

            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan"
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
