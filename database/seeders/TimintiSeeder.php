<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\timintis;
use Faker\Factory as Faker;

class TimintiSeeder extends Seeder
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
    		DB::table('timintis')->insert([
    			'nama' => $faker->name,
    			'ktp' => $faker->numberBetween(7773232928301,7775532928501),
    			'desa' => $faker->address,
    			'jumlahpemilih' => $faker->randomNumber(3),
    			'tps' => $faker->numberBetween(001,030),
    			'telpon' => $faker->numberBetween(628529239320,62853928332),
    			'latitude' => $faker->numberBetween($min = -223541000, $max = 43429000),
    			'longitude' => $faker->numberBetween($min = -2211000, $max = 7659000),
    			'yangdipilih' => $faker->randomNumber($nbDigits = NULL, $strict = false),
    			'foto' => $faker->name,
    		]);
 
    	}
    }
}
