<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'role' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        $request->session()->flash('success', 'Registrasi berhasil! Silahkan login.');
        return redirect(route('login'));
    }
}
