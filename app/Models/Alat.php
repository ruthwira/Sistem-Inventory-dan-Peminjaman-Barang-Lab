<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    public $primaryKey  = 'alat_id';

    protected $fillable = [
        'alat_nama', 'alat_keterangan', 'alat_total', 'path'
    ];
}