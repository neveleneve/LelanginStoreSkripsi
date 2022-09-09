<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PesertaController extends Controller
{
    public function ikutlelang(Request $request)
    {
        try {
            Penawaran::create([
                'id_user' => $request->id_user,
                'id_item' => $request->id_item,
                'penawaran' => $request->total_penawaran,
            ]);
        } catch (\Throwable $th) {
            Alert::alert('Oops!', 'Gagal menambahkan penawaran kamu!', 'warning');
            return redirect(route('viewitem', $request->item_mark));
        }
        Alert::alert('Yeay!', 'Berhasil memasukkan penawaran kamu!', 'success');
        return redirect(route('viewitem', $request->item_mark));
    }

    public function penawaran(Request $request)
    {
        dd($request->all());
    }
}
