<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\JoinBid;
use App\Models\User;
use App\Services\Midtrans\CreateSnapTokenService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentsController extends Controller
{
    public function finish(Request $request)
    {
        dd($request->all());
    }

    public function unfinish(Request $request)
    {
        dd($request->all());
    }

    public function error(Request $request)
    {
        dd($request->all());
    }

    public function joinbid(Request $request)
    {
        $id_item = $request->id_item;
        $id_user = $request->id_user;
        $cekdatajoin = JoinBid::where([
            'id_user' => $id_user,
            'id_item' => $id_item,
        ])
            ->where([
                ['payment_status', '<>', '3'],
                ['payment_status', '<>', '5']
            ])
            // ->orWhere('payment_status', '<>', '5')
            ->count();
        // dd($cekdatajoin);
        if ($cekdatajoin == 0) {
            JoinBid::insert([
                'id_user' => $id_user,
                'id_item' => $id_item,
                'number' => mt_rand(10000000, 99999999),
                'total_price' => 50000,
                'payment_status' => '1',
                'snap_token' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        $datajoin = JoinBid::where([
            'id_user' => $id_user,
            'id_item' => $id_item,
        ])->orderBy('created_at', 'desc')->get();

        $snapToken = $datajoin[0]->snap_token;

        $datapembayaran = [
            'transaction_details' => [
                'order_id' => $datajoin[0]->number,
                'gross_amount' => $datajoin[0]->total_price,
            ],
            'item_details' => [
                [
                    'id' => 'bid-join',
                    'price' => $datajoin[0]->total_price,
                    'quantity' => 1,
                    'name' => 'Join Lelang - LelanginStore'
                ]
            ],
        ];

        if (empty($snapToken)) {
            $midtrans = new CreateSnapTokenService($datapembayaran);
            $snapToken = $midtrans->getSnapToken();

            JoinBid::where([
                'id_user' => $id_user,
                'id_item' => $id_item,
            ])->update([
                'snap_token' => $snapToken
            ]);
        }
        return redirect()->intended('https://app.sandbox.midtrans.com/snap/v3/redirection/' . $snapToken);
    }

    public function check(Request $request)
    {
        $datajoinsebelum = JoinBid::where([
            'id_user' => $request->id_user,
            'id_item' => $request->id_item,
        ])
            ->orderBy('created_at', 'desc')
            ->first();
        $berubah = false;
        if ($datajoinsebelum != null) {
            // ambil data sebelum update untuk bisa dicek
            $idjoinbid = $datajoinsebelum->id;
            $datapaymentstatus = $datajoinsebelum->payment_status;
            $datanumber = $datajoinsebelum->number;

            $endpoint = "https://api.sandbox.midtrans.com/v2/" . $datanumber . "/status";
            $client = new \GuzzleHttp\Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(env('SERVER_KEY')),
                ]
            ]);
            $response = $client->request('GET', $endpoint);
            $content = json_decode($response->getBody(), true);

            $status_payment = null;
            if (isset($content['transaction_status'])) {
                if ($content['transaction_status'] == 'settlement') {
                    $status_payment = '4';
                } elseif ($content['transaction_status'] == 'pending') {
                    $status_payment = '2';
                } elseif ($content['transaction_status'] == 'cancel') {
                    $status_payment = '5';
                } elseif ($content['transaction_status'] == 'expire') {
                    $status_payment = '3';
                }
            } else {
                if ($content['status_code'] == '404') {
                    $status_payment = '1';
                }
            }
            if ($datapaymentstatus != $status_payment) {
                $berubah = true;
                JoinBid::where('id', $idjoinbid)->update([
                    'payment_status' => $status_payment
                ]);
            }
        }
        $datax = ['berubah' => $berubah];
        return Response($datax);
        // return dd([$content, $status_payment, $datapaymentstatus, $berubah]);
    }

    public function cancel(Request $request)
    {
        $endpoint = "https://api.sandbox.midtrans.com/v2/" . $request->number . "/cancel";
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(env('SERVER_KEY')),
            ]
        ]);
        $response = $client->request('POST', $endpoint);
        $content = json_decode($response->getBody(), true);
        Alert::alert('Yeay!', 'Berhasil membatalkan proses pembayaran ikut lelang!', 'success');
        return redirect(route('viewitem', ['id' => $request->id]));
    }
}
