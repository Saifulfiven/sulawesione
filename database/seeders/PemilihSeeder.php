<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\timintis;
use Faker\Factory as Faker;

class PemilihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
 
    	for($i = 1; $i <= 50; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('pemilihs')->insert([
    			'nama' => $faker->name,
    			'desa' => $faker->address,
    			'telpon' => $faker->numberBetween(628529239320,62853928332),
    			'yangdipilih' => $faker->randomNumber($nbDigits = NULL, $strict = false),
    			'jenispilihan' => $faker->randomNumber($nbDigits = NULL, $strict = false),
    			
    		]);
 
    	}
    }
}
