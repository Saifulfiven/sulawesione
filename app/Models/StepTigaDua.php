<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepTigaDua extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_stepSatu',
        'tigabelasperkuliahan',
        'tigabelasdemonstrasi',
        'tigabelaspartisipasi',
        'tigabelasmagang',
        'tigabelaspraktikum',
        'tigabelaskerja',
        'tigabelasdiskusi',
        'empatbelas',
        'limabelas',
        'limabelaslainnya',
        'tujuhbelas',
        'enambelas',
        'delapanbelas',
        'sembilanbelas',
        'sembilanbelaslainnya',
        'duapuluh',
        'duapuluhlainnya'

    ];
}
