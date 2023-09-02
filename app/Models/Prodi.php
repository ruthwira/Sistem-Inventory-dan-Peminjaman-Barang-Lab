<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    public $primaryKey  = 'prodi_id';

    protected $fillable = [
        'prodi_nama', 'prodi_fakultas'
    ];
}