<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Mohammad',
                'username' => 'neveleneve',
                'email' => 'superadministrator@gmail.com',
                'password' => Hash::make('superadministrator'),
                'role' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jojo',
                'username' => 'credentials',
                'email' => 'administrator@gmail.com',
                'password' => Hash::make('administrator'),
                'role' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Juragan Casio Indonesia',
                'username' => 'juragancasio',
                'email' => 'pelelang@gmail.com',
                'password' => Hash::make('pelelang'),
                'role' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sule',
                'username' => 'sule123',
                'email' => 'peserta@gmail.com',
                'password' => Hash::make('peserta'),
                'role' => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Eiger Tiger Watch',
                'username' => 'eigertiger',
                'email' => 'pelelang2@gmail.com',
                'password' => Hash::make('pelelang'),
                'role' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
