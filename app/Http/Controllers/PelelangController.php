<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelelangController extends Controller
{
    public function item()
    {
        $data = Item::where('id_user', Auth::user()->id)->get();
        return view('pelelang.item.index', [
            'item' => $data
        ]);
    }
}
