<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Alat;
use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlat;
use App\Models\PeminjamanRuang;

class HomeController extends Controller
{
    public function index()
    {
        return view('general.index');
    }
    
    public function daftar_alat()
    {
        $data = [];
        $data['alats'] = Alat::all();
        $data['peminjamanAlats'] = (new PeminjamanAlat())->getPair();
        $date = new DateTime(now());
        $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $wm1 = DateTime::createFromFormat('H:i:s', $date->format('H:i:s'));
        for ($i=0; $i < count($data['alats']); $i++) { 
            $e = $data['alats'][$i];
            if(array_key_exists($e['alat_id'], $data['peminjamanAlats'])){
                foreach ($data['peminjamanAlats'][$e['alat_id']] as $alat_id => $jwl) {
                    $wm2 = DateTime::createFromFormat('H:i:s', $jwl['waktu_mulai']);
                    $ws2 = DateTime::createFromFormat('H:i:s', $jwl['waktu_selesai']);
                    if($wm1 >= $wm2 && $wm1 <= $ws2){
                        $data['alats'][$i]['b'] = 0;
                        break;
                    }else{
                        $data['alats'][$i]['b'] = 1;
                    }
                }
            }else{
                $data['alats'][$i]['b'] = 1;
            }
        }
        return view('general.daftar_alat', $data);
    }

    public function daftar_ruang()
    {
        $data = [];
        $data['ruangs'] = Ruang::all();
        $data['peminjamanRuangs'] = (new PeminjamanRuang())->getPair();
        $date = new DateTime(now());
        $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $wm1 = DateTime::createFromFormat('H:i:s', $date->format('H:i:s'));
        for ($i=0; $i < count($data['ruangs']); $i++) { 
            $e = $data['ruangs'][$i];
            if(array_key_exists($e['ruang_id'], $data['peminjamanRuangs'])){
                foreach ($data['peminjamanRuangs'][$e['ruang_id']] as $ruang_id => $jwl) {
                    $wm2 = DateTime::createFromFormat('H:i:s', $jwl['waktu_mulai']);
                    $ws2 = DateTime::createFromFormat('H:i:s', $jwl['waktu_selesai']);
                    if($wm1 >= $wm2 && $wm1 <= $ws2){
                        $data['ruangs'][$i]['b'] = 0;
                        break;
                    }else{
                        $data['ruangs'][$i]['b'] = 1;
                    }
                }
            }else{
                $data['ruangs'][$i]['b'] = 1;
            }
        }
        return view('general.daftar_ruang', $data);
    }
}