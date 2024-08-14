<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitKerjaRequest;
use App\Http\Requests\UpdateUnitKerjaRequest;
use App\Models\UnitKerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $data = [
            'unit_kerja' => UnitKerja::all(),
            'pageTitle' => "Unit Kerja"
        ];
        return view('unit_kerja.index', $data);
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
            'nama_unit' => $r->nama_unit,
            'kode_unit' => $r->kode_unit
        ];

        $rules = [
            'nama_unit' => 'required|string|max:255',
            'kode_unit' => 'required|string|max:255|unique:unit_kerjas',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $unit_kerja = UnitKerja::create([
                'kode_unit' => $r->kode_unit,
                'nama_unit' => $r->nama_unit,
            ]);

            if($unit_kerja){
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
            $data = UnitKerja::where('id', $r->id)->first();

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
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'string' => 'Kolom :attribute harus berupa teks.'
        ];

        $data = [
            'kode_unit' => $r->kode_unit,
            'nama_unit' => $r->nama_unit,
        ];

        $rules = [
            'kode_unit' => 'required|string|max:5',
            'nama_unit' => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        try{
            $data = UnitKerja::where("id", $r->id)->first();

            if($data){
                $data->kode_unit = $r->kode_unit;
                $data->nama_unit = $r->nama_unit;
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
            $data = UnitKerja::where('id', $r->id)->first();

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
