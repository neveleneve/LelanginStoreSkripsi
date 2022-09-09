<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namaitemcasio = [
            'Casio General MTPV004L1AUDF',
            'Casio Digital Illuminator AE-1000W-2AV',
            'Casio G-Shock One Piece',
            'Casio Standard AW-90H-9EVDF',
            'Casio G-Shock GX-56BB-1DR',
        ];
        $namaitemeiger = [
            'Eiger Liville Watch - Navy',
            'Eiger Alverstone Watch - Navy',
            'Eiger Helicon - Olive',
            'Eiger Touchdigi TYP11528-01 Watch - Grey',
            'Eiger Creston Watch - Grey',
        ];
        $id_item = [
            'I-UYNH2',
            'I-2JFJB',
            'I-DP8J2',
            'I-Z9L0N',
            'I-HXVKW',
            'I-OCSMN',
            'I-0WJQP',
            'I-WLE01',
            'I-EAAVH',
            'I-DF51R',
        ];
        for ($i = 0; $i < count($namaitemcasio); $i++) {
            Item::create([
                'id_item' => $id_item[$i],
                'id_user' => 3,
                'name' => $namaitemcasio[$i],
                'start_price' => 750000,
                'start_date' => date('Y-m-d H:i:s', strtotime('12:00:00 +' . rand(-2, 1) . 'days')),
                'end_date' => date('Y-m-d H:i:s', strtotime('21:00:00 +' . rand(2, 4) . 'days')),
            ]);
        }
        for ($i = 0; $i < count($namaitemeiger); $i++) {
            Item::create([
                'id_item' => $id_item[$i + 5],
                'id_user' => 5,
                'name' => $namaitemeiger[$i],
                'start_price' => 750000,
                'start_date' => date('Y-m-d H:i:s', strtotime('12:00:00 +' . rand(-2, 1) . 'days')),
                'end_date' => date('Y-m-d H:i:s', strtotime('21:00:00 +' . rand(2, 4) . 'days')),
            ]);
        }
    }

    public function generateRandomString($length = 5)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
