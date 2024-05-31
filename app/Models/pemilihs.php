<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\timintis;
use Faker\Factory as Faker;

class pemilihs extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'desa',
        'kontak',
        'id_kabupaten',
        'id_timpengguna',
        'jenispilihan',
        'id_dapil',
        'id_kecamatan',
        'id_kabupaten',
        'id_provinsi'
    ];
}
