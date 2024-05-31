<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepDua extends Model
{
    use HasFactory;
    protected $fillable = [
            'id_stepSatu',
            'satu',
            'duaA',
            'duaB',
            'duaC',
            'tiga',
            'empatP',
            'empat_lainnya',
            'lima',
            'enam',
            'tujuh',
            'delapan_biaya',
            'delapan_program',
            'delapan_kampus',
            'delapan_tahun',
            'sembilanP',
            'sembilan_lainnya',
            'sepuluh'
    ];
}
