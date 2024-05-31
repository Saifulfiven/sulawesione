<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepSatu extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'namalengkap',
        'kontak',
        'kodeprodi',
        'tahunlulus',
        'email',
        'nik',
        'npwp'
    ];
}
