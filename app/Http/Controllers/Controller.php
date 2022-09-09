<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tanggalIndo($date)
    {
        $tanggal = date('d', strtotime($date));
        $bulan = date('m', strtotime($date));
        $namabulan = null;
        $tahun = date('Y', strtotime($date));
        $jam = date('H:i:s', strtotime($date));

        switch ($bulan) {
            case '01':
                $namabulan = 'Januari';
                break;
            case '02':
                $namabulan = 'Februari';
                break;
            case '03':
                $namabulan = 'Maret';
                break;
            case '04':
                $namabulan = 'April';
                break;
            case '05':
                $namabulan = 'Mei';
                break;
            case '06':
                $namabulan = 'Juni';
                break;
            case '07':
                $namabulan = 'Juli';
                break;
            case '08':
                $namabulan = 'Agustus';
                break;
            case '09':
                $namabulan = 'September';
                break;
            case '10':
                $namabulan = 'Oktober';
                break;
            case '11':
                $namabulan = 'November';
                break;
            case '12':
                $namabulan = 'Desember';
                break;
            default:
                break;
        }

        $tgl = $tanggal . ' ' . $namabulan . ' ' . $tahun . ', Pukul ' . $jam;

        return $tgl;
    }

    public function checkImage($folder)
    {
        $namagambar = '';
        $jumlahgambar = count(File::allFiles(public_path('/images/' . $folder)));
        if ($jumlahgambar > 0) {
            $namagambar = url('images/' . $folder . '/1.png');
        } else {
            $namagambar = url('images/default.jpg');
        }
        return $namagambar;
    }

    public function cencorName($username)
    {
        // $target = "example@example.com";
        $count = strlen($username) - (strlen($username) - (strlen($username) - 4));
        $output = substr_replace($username, str_repeat('*', $count), 2, $count);
        return $output;
    }
}
