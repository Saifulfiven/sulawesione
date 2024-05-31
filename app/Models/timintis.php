<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timintis extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'ktp',
        'desa',
        'jumlahpemilih','tps','telpon','latitude','longitude','yangdipilih','foto'
    ];
}
