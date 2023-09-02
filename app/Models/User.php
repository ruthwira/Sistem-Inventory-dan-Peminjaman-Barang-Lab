<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $primaryKey  = 'user_id';

    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function mahasiswa(){
        return $this->hasOne(Mahasiswa::class, 'user_id', 'user_id');
    }

    public function dosen(){
        return $this->hasOne(Dosen::class, 'user_id', 'user_id');
    }

    public function peminjaman_ruang(){
        return $this->hasMany(PeminjamanRuang::class, 'user_id', 'user_id');
    }
}