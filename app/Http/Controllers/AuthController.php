<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user()->role;
            $request->session()->regenerate();

            if($user === 'admin')
                return redirect()->intended('/admin/dashboard');

            if($user === 'siswa')
                return redirect()->intended('/siswa/beranda');
        }

        return back()->withErrors([
            'username' => 'NIP / NIS atau Password yang anda masukkan tidak valid.'
        ])->onlyInput('username');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }
}
