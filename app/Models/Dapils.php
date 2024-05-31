<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapils extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kabupaten',
        'id_kandidat',
        'id_provinsi',
        'customer',
        'jeniskandidat'
    ];
}
