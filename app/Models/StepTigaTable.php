<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepTigaTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'seblas',
        'duabelasaetika',
        'duabelasakeahlian',
        'duabelasainggris',
        'duabelasatekonologi',
        'duabelasakomunikasi',
        'duabelasasamatim',
        'duabelasapengembangan',
        'duabelasbetika',
        'duabelasbkeahlian',
        'duabelasbinggris',
        'duabelasbtekonologi',
        'duabelasbkomunikasi',
        'duabelasbsamatim',
        'duabelasbpengembangan',
        'id_stepSatu'
    ];
}
