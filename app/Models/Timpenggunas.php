<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timpenggunas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'ktp',
        'id_kecamatan', 'id_kabupaten','id_provinsi','alamat','kontak','username',
        'latitude','longitude','id_timinti',
        'id_dapil','foto','id_desa','jenistim','email','password','remember_token','jumlahpemilihrumahtangga','nomortps'
    ];
}
