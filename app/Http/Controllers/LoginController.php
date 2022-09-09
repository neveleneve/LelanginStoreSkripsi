<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd('berhasil login');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::alert('Yeay!', 'Selamat datang kembali, ' . Auth::user()->username . '!', 'success');
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Tidak dapat menemukan data login'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('landing'));
    }
}
