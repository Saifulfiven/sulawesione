<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
            Admin::create([
                'name' => 'admin',
                'email' => 'admin@multi-auth.test',
                'password' => bcrypt(12345678),
                'ktp'           => '112233445566',
                'desa'          => '2',
                'jumlahpemilih' => '1000',
                'tps'           => 'TPS 1',
                'telpon'        => '08123456789',
                'latitude'      => '123.456',
                'longitude'     => '456.789',
                'yangdipilih'   => '23',
                'foto'          => 'sulawesi.png',
                'role'          => 'timinti'
            ]);
        
    }
}
