<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    public $primaryKey  = 'ruang_id';

    protected $fillable = [
        'ruang_nama', 'ruang_keterangan', 'ruang_lab', 'ruang_letak', 'ruang_kapasitas'
    ];
}