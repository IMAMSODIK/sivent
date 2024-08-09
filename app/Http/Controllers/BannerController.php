<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Exception;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $data = [
            'banner' => Banner::all()
        ];
        return view('banner.index', $data);
    }

    public function store(Request $r){
        $banner = null;

        if ($r->hasFile('banner')) {
            $file = $r->file('banner');
            $fileMimeType = $file->getClientMimeType();

            if ($fileMimeType != 'image/png' && $fileMimeType != 'image/jpg' && $fileMimeType != 'image/jpeg') {
                return response()->json([
                    'status' => false,
                    'message' => "Jenis File Tidak Didukung"
                ]);
            }

            $banner = bin2hex(random_bytes(10)) . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('banner', $banner, 'public');
        }else{
            return response()->json([
                'status' => false,
                'message' => "Gambar belum diupload"
            ]);
        }

        try{
            $banner = Banner::create([
                'file' => $banner,
            ]);

            if($banner){
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

    // public function edit(Request $r){
    //     try{
    //         $data = UnitKerja::where('id', $r->id)->first();

    //         if($data){
    //             return response()->json([
    //                 'status' => true,
    //                 'data' => $data
    //             ]);    
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => "Data tidak ditemukan"
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    // public function update(Request $r){
    //     $messages = [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
    //         'string' => 'Kolom :attribute harus berupa teks.'
    //     ];

    //     $data = [
    //         'kode_unit' => $r->kode_unit,
    //         'nama_unit' => $r->nama_unit,
    //     ];

    //     $rules = [
    //         'kode_unit' => 'required|string|max:5',
    //         'nama_unit' => 'required|string|max:255',
    //     ];

    //     $validator = Validator::make($data, $rules, $messages);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => implode(', ', $validator->errors()->all())
    //         ]);
    //     }

    //     try{
    //         $data = UnitKerja::where("id", $r->id)->first();

    //         if($data){
    //             $data->kode_unit = $r->kode_unit;
    //             $data->nama_unit = $r->nama_unit;
    //             $data->save();

    //             return response()->json([
    //                 'status' => true
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => "Gagal mengubah data"
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    // public function delete(Request $r){
    //     try{
    //         $data = UnitKerja::where('id', $r->id)->first();

    //         if($data){
    //             $data->delete();

    //             return response()->json([
    //                 'status' => true
    //             ]);   
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => "Data tidak ditemukan"
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }
}
