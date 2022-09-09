<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function users()
    {
        $datauser = User::where([
            ['role', '<>', '0'],
            ['role', '<>', '1']
        ])->get();
        return view('admin.users.index', [
            'user' => $datauser
        ]);
    }

    public function payments()
    {
        return view('admin.payments.index');
    }

    public function websetting()
    {
        return view('admin.websetting.index');
    }

    public function usersadmin()
    {
        if (Auth::user()->role == 0) {
            $datauser = User::where([
                ['role', '<>', '2'],
                ['role', '<>', '3']
            ])->get();
            return view('admin.administrator.index', [
                'user' => $datauser
            ]);
        } else {
            return redirect(route('admindashboard'));
        }
    }
}
