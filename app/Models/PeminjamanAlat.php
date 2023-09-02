<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAlat extends Model
{
    use HasFactory;
    public $primaryKey  = 'peminjaman_alat_id';

    protected $fillable = [
        'alat_id', 'user_id','nama_kegiatan', 'pj_kegiatan', 'deskripsi_kegiatan', 'alat_total','tanggal_mulai', 'waktu_mulai', 'tanggal_selesai', 'waktu_selesai', 'status_peminjaman', 'path_dokumen'
    ];

     public function getPair(){
        $res = [];
        $temp = $this->where('tanggal_mulai', '=', date('Y-m-d'))->where('status_peminjaman', 'acc')->orderBy('waktu_mulai', 'ASC')->get();
        foreach ($temp as $i => $t) {
            if(!array_key_exists($t['alat_id'], $res)){
                $res[$t['alat_id']] = [];
            }
            $jwl = [
                'waktu_mulai' => $t['waktu_mulai'],
                'waktu_selesai' => $t['waktu_selesai'],
            ];
            array_push($res[$t['alat_id']], $jwl);
        }
        return $res;
    }

    public function alat(){
        return $this->hasOne(Alat::class, 'alat_id', 'alat_id');
    }
    
    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}