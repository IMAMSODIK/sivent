<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(){
        $data = [
            'user' => Auth::user(),
            'unit_kerja' => UnitKerja::select('id', 'nama_unit')->get(),
        ];
        return view('profile.index', $data);
    }
}
