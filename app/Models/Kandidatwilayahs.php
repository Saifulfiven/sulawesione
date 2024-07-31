<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidatwilayahs extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_dapil',
        'namakandidat',
    ];


}
