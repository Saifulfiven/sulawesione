<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

//class Admin extends Model
class Admin extends Authenticable

{
    //use HasFactory;
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'username', 'password','email_verfied_at',
        'ktp',
        'desa',
        'jumlahpemilih','tps','telpon','latitude','longitude','yangdipilih','foto','role'
    ];

    protected $hidden = ['password'];
}
