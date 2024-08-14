<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        $data = [
            'pageTitle' => 'Login'
        ];
        return view('auth.login', $data);
    }

    public function loginCheck(Request $r){
        if(Auth::attempt(['username' => $r->username, 'password' => $r->password])){
            $r->session()->regenerate();
            session()->put('user', Auth::user());

            if(Auth::user()->role == 'peserta'){
                return redirect('/peserta-page/daftar-event');    
            }

            return redirect('/dashboard');
        }else{
            return redirect('/login')->with("error", $r->username);
        }
    }

    public function logout(Request $r){
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return response()->json([
            'status' => true,
        ]);
    }
}
