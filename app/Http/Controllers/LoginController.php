<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Login"
        ]);
    }

    public function authenticate(Request $request)
    {
        // Validasi input dari pengguna
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

        // Tentukan apakah input adalah email atau username
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Siapkan kredensial untuk autentikasi
        $authCredentials = [
            $loginField => $credentials['login'],
            'password' => $credentials['password'],
        ];

        // Mencoba untuk mengautentikasi pengguna dengan kredensial yang diberikan
        if (Auth::attempt($authCredentials)) {
            // Jika autentikasi berhasil, regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            // Redirect pengguna ke halaman yang diinginkan (default ke '/')
            if (Auth::user()->is_admin) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('dashboard');
            }
        }

        // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan kesalahan
        return back()->withErrors([
            'loginError' => 'Login failed'
        ])->onlyInput('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function admin(){
        return view('admin.index',['title'=>'Admin']);
    }

}
