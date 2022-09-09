<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\JoinBid;
use App\Models\Payment;
use App\Models\Penawaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Midtrans\CreateSnapTokenService;

class HomeController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function landing()
    {
        // data sementara
        $dataterbaru = Item::join('users', 'items.id_user', '=', 'users.id')
            ->orderBy('start_date', 'asc')
            ->where('start_date', '>=', date('Y-m-d H:i:s'))
            ->take(4)
            ->get([
                'users.id as id_user',
                'users.username',
                'items.*'
            ]);
        $datahampirselesai = Item::join('users', 'items.id_user', '=', 'users.id')
            ->orderBy('end_date', 'asc')
            ->where('end_date', '>', date('Y-m-d H:i:s'))
            ->where('start_date', '<', date('Y-m-d H:i:s'))
            ->take(4)
            ->get([
                'users.id as id_user',
                'users.username',
                'items.*'
            ]);
        return view('welcome', [
            'databaru' => $dataterbaru,
            'dataselesai' => $datahampirselesai,
        ]);
    }

    public function setting()
    {
        return view('setting');
    }

    public function viewprofile($id)
    {
        return view('profile-view');
    }

    public function viewitem($id)
    {
        try {
            $explode = explode('|', base64_decode($id));
            $dataitem = Item::join(User::getTableName(), 'items.id_user', '=', 'users.id')
                ->where('items.id', $explode[1])
                ->first([
                    'users.username',
                    'items.*'
                ]);
            $jumlahgambar = count(File::allFiles(public_path('/images/' . $dataitem->id_item . '_' . $dataitem->id_user)));
            // $datapenawaran = Penawaran::where('')
            $datapenawaran = Penawaran::join(User::getTableName(), 'penawarans.id_user', '=', 'users.id')
                ->where('id_item', $explode[1])
                ->orderBy('penawaran', 'desc')
                ->get([
                    'penawarans.*',
                    'users.username',
                ]);
            if (Auth::check()) {
                $cekjoinbid = JoinBid::where([
                    'id_user' => Auth::user()->id,
                    'id_item' => $explode[1],
                ])
                    ->orderBy('created_at', 'desc')
                    ->first();
                $passingdata = [
                    'itemmark' => $id,
                    'item' => $dataitem,
                    'gambar' => $jumlahgambar,
                    'auth' => Auth::check(),
                    'joinbid' => $cekjoinbid,
                    'penawaran' => $datapenawaran,
                ];
            } else {
                $passingdata = [
                    'itemmark' => $id,
                    'item' => $dataitem,
                    'gambar' => $jumlahgambar,
                    'auth' => Auth::check(),
                    'penawaran' => $datapenawaran,
                ];
            }
        } catch (\Throwable $th) {
            Alert::alert('Oops!', 'Item yang kamu ingin kunjungi tidak tersedia!', 'warning');
            return redirect(route('landing'));
        }
        return view('item', $passingdata);
    }
}
