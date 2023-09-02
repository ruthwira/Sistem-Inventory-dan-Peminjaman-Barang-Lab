<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    public $primaryKey  = 'mahasiswa_id';

    protected $fillable = [
        'mahasiswa_nama', 'user_id', 'mahasiswa_nim', 'mahasiswa_prodi', 'mahasiswa_angkatan',
    ];

    public function prodi(){
        return $this->hasOne(Prodi::class, 'prodi_id', 'mahasiswa_prodi');
    }
}