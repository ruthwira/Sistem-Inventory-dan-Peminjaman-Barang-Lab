<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Alat;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlat;
use App\Models\PeminjamanRuang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    // General
    public function index(){
        $year = date('Y');
        $month = date('m');
        $data = [];
        $data['page'] = 'index';
        $data['ruangs'] = Ruang::all();
        $data['alats'] = Alat::all();
        $data['peminjamans'] = PeminjamanRuang::where('tanggal_mulai', '>=', date('Y-m-d'))->get();
        $data['pengajuan_bulan_ini'] = PeminjamanRuang::whereMonth('tanggal_mulai', $month)
            ->whereYear('tanggal_mulai', $year)
            ->where('status_peminjaman', 'proses')
            ->get();
        $data['peminjaman_bulan_ini'] = PeminjamanRuang::whereMonth('tanggal_mulai', $month)
            ->whereYear('tanggal_mulai', $year)
            ->where('status_peminjaman', 'acc')
            ->get();
        return view('admin.index', $data);
    }
    public function profile(){
        $data = [];
        $data['user'] = User::where('user_id', auth()->user()->user_id)->first();
        return view('admin.profile', $data);
    }
    public function update_profile(Request $request){
        $data = $request->all();
        $user = User::where('user_id', auth()->user()->user_id)->first();
        if($user){
            $user->name = $data['name'];
            $user->email = $data['email'];
            $boolUser = $user->save();

            if($boolUser){
                return redirect('/admin/profile')->with(['successInfo'=>'Berhasil memperbaharui profile']);
            }else{
                return redirect('/admin/profile')->with(['errorInfo'=>'Gagal memperbaharui profile']);
            }

        }else{
            return redirect()->route('admin.index');
        }
    }
    public function update_password(Request $request){
        $data = $request->all();
        $user = User::where('user_id', auth()->user()->user_id)->first();
        $pwLama = $data['password_lama'];
        $pwBaru = $data['password_baru'];
        $hashedLama = $user['password'];
        if(Hash::check($pwLama, $hashedLama)){
            $user->password = bcrypt($pwBaru);
            $bool = $user->save();
            if($bool){
                return redirect('/admin/profile')->with(['successPW'=>'Berhasil memperbaharui password']);
            }else{
                return redirect('/admin/profile')->with(['errorPW'=>'Gagal memperbaharui password']);
            }
        }else{  
            return redirect()->back()->withErrors(['pwLama'=>'Password Lama tidak sesuai']);   
        }
    }


    
    // Ruang
    public function daftar_ruang(){
        $data = [];
        $data['ruangs'] = Ruang::get();
        $data['page'] = 'daftar_ruang';
        return view('admin.ruang', $data);
    }
    public function tambah_ruang(){
        $data = [];
        $data['page'] = 'daftar_ruang';
        return view('admin.tambah_ruang', $data);
    }
    public function detail_ruang($id_ruang){
        $data = [];
        $data['page'] = 'daftar_ruang';
        $data['ruang'] = Ruang::where('ruang_id', $id_ruang)->first();
        if($data['ruang']){
            return view('admin.detail_ruang', $data);
        }else{
            return redirect('/admin/ruang')->with(['error'=>'Ruangan tidak ditemukan']);
        }
    }
    public function daftar_peminjaman_ruang(){
        $data = [];
        $data['peminjamanRuangs'] = PeminjamanRuang::where('tanggal_mulai', '>=', date('Y-m-d'))->get();
        $data['page'] = 'daftar_peminjaman_ruang';
        return view('admin.daftar_peminjaman_ruang', $data);
    }
    public function detail_peminjaman_ruang($id_peminjaman_ruang){
        $data = [];
        $data['peminjaman'] = PeminjamanRuang::where('peminjaman_ruang_id', $id_peminjaman_ruang)->first();
        if($data['peminjaman']){
            $user_id = $data['peminjaman']['user_id'];
            $data['page'] = 'daftar_peminjaman_ruang';
            $data['user'] = User::where('user_id', $user_id)->first();
            $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            if($data['isMahasiswa']){
                $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            }else{
                $data['dosen'] = Dosen::where('user_id', $user_id)->first();
            }
            $data['ruangs'] = Ruang::all();
            $today = date("Y-m-d"); //Today
            $tglMulai = $data['peminjaman']['tanggal_mulai']; //Date
    
            if (strtotime($today) > strtotime($tglMulai)) {
                $isDateValid = false;
            }else{
                $isDateValid = true;
            }
            // Pengajuan peminjaman ruang hanya bisa diubah jika tanggal mulai masih valid (bukan peminjaman yang lalu) dan status peminjaman masih proses
            $data['isEditable'] = $isDateValid;
            if($data['peminjaman']['status_peminjaman'] == 'proses'){
                $data['status_peminjaman'] = 'Proses';
                $data['class_status_peminjaman'] = 'bg-warning border-warning';
            }else if($data['peminjaman']['status_peminjaman'] == 'tolak'){
                $data['status_peminjaman'] = 'Ditolak';
                $data['class_status_peminjaman'] = 'bg-danger border-danger';
            }else if($data['peminjaman']['status_peminjaman'] == 'acc'){
                $data['status_peminjaman'] = 'Diterima';
                $data['class_status_peminjaman'] = 'bg-success border-success';
            }
            return view('admin.detail_peminjaman_ruang', $data);
        }else{
            return redirect('/admin/ruang/peminjaman')->with(['error'=>'Peminjaman Ruangan tidak ditemukan']);
        }
    }
    public function riwayat_peminjaman_ruang(){
        $data = [];
        $data['peminjamanRuangs'] = PeminjamanRuang::where('tanggal_mulai', '<', date('Y-m-d'))->get();
        $data['page'] = 'riwayat_peminjaman_ruang';
        return view('admin.riwayat_peminjaman_ruang', $data);
    }
    public function detail_riwayat_peminjaman_ruang($id_peminjaman_ruang){
        $data = [];
        $data['peminjaman'] = PeminjamanRuang::where('peminjaman_ruang_id', $id_peminjaman_ruang)->first();
        if($data['peminjaman']){
            $user_id = $data['peminjaman']['user_id'];
            $data['page'] = 'riwayat_peminjaman_ruang';
            $data['user'] = User::where('user_id', $user_id)->first();
            $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            if($data['isMahasiswa']){
                $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            }else{
                $data['dosen'] = Dosen::where('user_id', $user_id)->first();
            }
            $data['ruangs'] = Ruang::all();
            $data['isEditable'] = false;
            if($data['peminjaman']['status_peminjaman'] == 'proses'){
                $data['status_peminjaman'] = 'Proses';
                $data['class_status_peminjaman'] = 'bg-warning border-warning';
            }else if($data['peminjaman']['status_peminjaman'] == 'tolak'){
                $data['status_peminjaman'] = 'Ditolak';
                $data['class_status_peminjaman'] = 'bg-danger border-danger';
            }else if($data['peminjaman']['status_peminjaman'] == 'acc'){
                $data['status_peminjaman'] = 'Diterima';
                $data['class_status_peminjaman'] = 'bg-success border-success';
            }
            return view('admin.detail_riwayat_peminjaman_ruang', $data);
        }else{
            return redirect('/admin/ruang/riwayat')->with(['error'=>'Peminjaman Ruangan tidak ditemukan']);
        }
    }
    public function aksi_peminjaman_ruang(Request $request){
        $data = $request->all();
        $peminjamanRuang = PeminjamanRuang::where('peminjaman_ruang_id', $data['id_peminjaman_ruang'])->first();
        if($peminjamanRuang){
            if($data['status_peminjaman'] == 'acc'){
                $temp = PeminjamanRuang::where('tanggal_mulai', $peminjamanRuang['tanggal_mulai'])->where('ruang_id', $peminjamanRuang['ruang_id'])->where('status_peminjaman', 'acc')->orderBy('waktu_mulai', 'ASC')->get();
                $isValid = true;
                foreach ($temp as $i => $t) {
                    $wm1 = DateTime::createFromFormat('H:i:s', $peminjamanRuang['waktu_mulai']);
                    $ws1 = DateTime::createFromFormat('H:i:s', $peminjamanRuang['waktu_selesai']);
                    $wm2 = DateTime::createFromFormat('H:i:s', $t['waktu_mulai']);
                    $ws2 = DateTime::createFromFormat('H:i:s', $t['waktu_selesai']);
                    // Setelah acara lain
                    if($wm1 >= $ws2){
                        $isValid = true;
                    }else if($wm1 < $wm2 && $ws1 <= $wm2){ 
                        $isValid = true;
                    }else{
                        $isValid = false;
                        break;
                    }
                    dd($ws1);
                    //  10 >= 12 || 13 <= 9
                    // 10 >= 8 || 13 <= 8.30
                    // if($wm1 >= $ws2 || $ws1 <= $wm2 ){
                    //     $isValid = true;
                    //     echo 'plot true';
                    // }else{
                    //     $isValid = false;
                    //     echo 'plot false';
                    //     break;
                    // }
                }
                if($isValid){
                    $peminjamanRuang->status_peminjaman = 'acc';
                    $boolPeminjamaRuang = $peminjamanRuang->save();
                    if($boolPeminjamaRuang){
                        return redirect('/admin/ruang/peminjaman/' . $peminjamanRuang->peminjaman_ruang_id)->with(['success'=>'Peminjaman Ruang berhasil disetujui']);
                    }else{
                        return redirect('/admin/ruang/peminjaman/' . $peminjamanRuang->peminjaman_ruang_id)->with(['error'=>'Peminjaman Ruang tidak gagal disetujui. Silakan coba lagi']);
                    }
                }else{
                    return redirect('/admin/ruang/peminjaman/' . $peminjamanRuang->peminjaman_ruang_id)->with(['error'=>'Peminjaman Ruang tidak dapat disetujui karena jadwal digunakan untuk kegiatan lain']);
                }
            }else{
                $peminjamanRuang->status_peminjaman = $data['status_peminjaman'];
                $boolPeminjamaRuang = $peminjamanRuang->save();
                if($boolPeminjamaRuang){
                    return redirect('/admin/ruang/peminjaman/' . $peminjamanRuang->peminjaman_ruang_id)->with(['success'=>'Peminjaman Ruang berhasil diubah']);
                }else{
                    return redirect('/admin/ruang/peminjaman/' . $peminjamanRuang->peminjaman_ruang_id)->with(['error'=>'Peminjaman Ruang gagal diubah']);
                }
            }
        }else{
            return redirect('/admin/ruang')->with(['error'=>'Peminjaman Ruangan tidak ditemukan']);
        }
    }
    public function add_ruang(Request $request){
        $data = $request->all();
        if($data['ruang_lab'] == 'Lab 2'){
            $data['ruang_letak'] = 'Agape Lt. 2';
        }else if($data['ruang_lab'] == 'Lab 3'){
            $data['ruang_letak'] = 'Agape Lt. 3';
        }else{
            $data['ruang_letak'] = 'Agape Lt. 4';
        }
        $fileFotoRuang = 'Foto ' . $data['ruang_nama'] . '.' . $request->path->extension();  
        $request->path->move(public_path('img/ruang/'), $fileFotoRuang);
        $ruang = Ruang::create([
            'ruang_nama' => $data['ruang_nama'], 
            'ruang_keterangan' => $data['ruang_keterangan'], 
            'ruang_lab' => $data['ruang_lab'], 
            'ruang_letak' => $data['ruang_letak'], 
            'ruang_kapasitas' => $data['ruang_kapasitas'],
            'path' => $fileFotoRuang
        ]);
        if($ruang){
            return redirect('/admin/ruang/detail/' . $ruang->ruang_id)->with(['success'=>'Ruangan berhasil ditambahkan']);
        }else{
            return redirect('/admin/ruang')->with(['error'=>'Ruangan gagal ditambahkan']);
        }
    }
    public function update_ruang(Request $request){
        $data = $request->all();
        $ruang = Ruang::where('ruang_id', $data['id_ruang'])->first();
        if($ruang){
            if(isset($data['path'])){
                $fileFotoRuang = 'Foto ' . $data['ruang_nama'] . '.' . $request->path->extension();  
                $request->path->move(public_path('img/ruang/'), $fileFotoRuang);
                $ruang->path = $fileFotoRuang;
            }
            if($data['ruang_lab'] == 'Lab 2'){
                $data['ruang_letak'] = 'Agape Lt. 2';
            }else if($data['ruang_lab'] == 'Lab 3'){
                $data['ruang_letak'] = 'Agape Lt. 3';
            }else{
                $data['ruang_letak'] = 'Agape Lt. 4';
            }
            $ruang->ruang_nama = $data['ruang_nama'];
            $ruang->ruang_keterangan = $data['ruang_keterangan'];
            $ruang->ruang_lab = $data['ruang_lab'];
            $ruang->ruang_letak = $data['ruang_letak'];
            $ruang->ruang_kapasitas = $data['ruang_kapasitas'];
            $boolRuang = $ruang->save();
            if($boolRuang){
                return redirect('/admin/ruang/detail/' . $ruang->ruang_id)->with(['success'=>'Ruangan berhasil diperbaharui']);
            }else{
                return redirect('/admin/ruang/detail/' . $ruang->ruang_id)->with(['error'=>'Ruangan gagal diperbaharui']);
            }
        }else{
            return redirect('/admin/ruang')->with(['error'=>'Ruangan tidak ditemukan']);
        }
    }
    public function delete_ruang(Request $request){
        $data = $request->all();
        $peminjaman_ruang = PeminjamanRuang::where('ruang_id', $data['id_ruang'])->get();
        if(count($peminjaman_ruang)){
            return redirect('/admin/ruang')->with(['error'=>'Ruangan gagal dihapus karena sudah ada data peminjaman']);
        }else{
            $boolPR = PeminjamanRuang::where('ruang_id', $data['id_ruang'])->delete();
            $boolRuang = Ruang::where('ruang_id', $data['id_ruang'])->delete();
            return redirect('/admin/ruang')->with(['success'=>'Ruangan berhasil dihapus']);
        }
    }



    // Alat
    public function daftar_alat(){
        $data = [];
        $data['alats'] = Alat::get();
        $data['page'] = 'daftar_alat';
        return view('admin.alat', $data);
    }
    public function tambah_alat(){
        $data = [];
        $data['page'] = 'daftar_alat';
        return view('admin.tambah_alat', $data);
    }
    public function detail_alat($id_alat){
        $data = [];
        $data['page'] = 'daftar_alat';
        $data['alat'] = Alat::where('alat_id', $id_alat)->first();
        if($data['alat']){
            return view('admin.detail_alat', $data);
        }else{
            return redirect('/admin/alat')->with(['error'=>'Alat tidak ditemukan']);
        }
    }
    public function daftar_peminjaman_alat(){
        $data = [];
        $data['peminjamanAlats'] = PeminjamanAlat::where('tanggal_mulai', '>=', date('Y-m-d'))->orderBy('tanggal_mulai', 'DESC')->orderBy('waktu_mulai', 'ASC')->get();
        $data['page'] = 'daftar_peminjaman_alat';
        return view('admin.daftar_peminjaman_alat', $data);
    }
    public function detail_peminjaman_alat($id_peminjaman_alat){
        $data = [];
        $data['peminjaman'] = PeminjamanAlat::where('peminjaman_alat_id', $id_peminjaman_alat)->first();
        if($data['peminjaman']){
            $user_id = $data['peminjaman']['user_id'];
            $data['page'] = 'daftar_peminjaman_alat';
            $data['user'] = User::where('user_id', $user_id)->first();
            $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            if($data['isMahasiswa']){
                $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            }else{
                $data['dosen'] = Dosen::where('user_id', $user_id)->first();
            }
            $data['alats'] = Alat::all();
            $today = date("Y-m-d"); //Today
            $tglMulai = $data['peminjaman']['tanggal_mulai']; //Date
    
            if (strtotime($today) > strtotime($tglMulai)) {
                $isDateValid = false;
            }else{
                $isDateValid = true;
            }
            // Pengajuan peminjaman alat hanya bisa diubah jika tanggal mulai masih valid (bukan peminjaman yang lalu) dan status peminjaman masih proses
            $data['isEditable'] = $isDateValid;
            if($data['peminjaman']['status_peminjaman'] == 'proses'){
                $data['status_peminjaman'] = 'Proses';
                $data['class_status_peminjaman'] = 'bg-warning border-warning';
            }else if($data['peminjaman']['status_peminjaman'] == 'tolak'){
                $data['status_peminjaman'] = 'Ditolak';
                $data['class_status_peminjaman'] = 'bg-danger border-danger';
            }else if($data['peminjaman']['status_peminjaman'] == 'acc'){
                $data['status_peminjaman'] = 'Diterima';
                $data['class_status_peminjaman'] = 'bg-success border-success';
            }
            return view('admin.detail_peminjaman_alat', $data);
        }else{
            return redirect('/admin/alat')->with(['error'=>'Peminjaman Alat tidak ditemukan']);
        }
    }
    public function riwayat_peminjaman_alat(){
        $data = [];
        $data['peminjamanAlats'] = PeminjamanAlat::where('tanggal_mulai', '<', date('Y-m-d'))->get();
        $data['page'] = 'riwayat_peminjaman_alat';
        return view('admin.riwayat_peminjaman_alat', $data);
    }
    public function detail_riwayat_peminjaman_alat($id_peminjaman_alat){
        $data = [];
        $data['peminjaman'] = PeminjamanAlat::where('peminjaman_alat_id', $id_peminjaman_alat)->first();
        if($data['peminjaman']){
            $user_id = $data['peminjaman']['user_id'];
            $data['page'] = 'riwayat_peminjaman_alat';
            $data['user'] = User::where('user_id', $user_id)->first();
            $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            if($data['isMahasiswa']){
                $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            }else{
                $data['dosen'] = Dosen::where('user_id', $user_id)->first();
            }
            $data['alats'] = Alat::all();
            // Pengajuan peminjaman alat hanya bisa diubah jika tanggal mulai masih valid (bukan peminjaman yang lalu) dan status peminjaman masih proses
            $data['isEditable'] = false;
            if($data['peminjaman']['status_peminjaman'] == 'proses'){
                $data['status_peminjaman'] = 'Proses';
                $data['class_status_peminjaman'] = 'bg-warning border-warning';
            }else if($data['peminjaman']['status_peminjaman'] == 'tolak'){
                $data['status_peminjaman'] = 'Ditolak';
                $data['class_status_peminjaman'] = 'bg-danger border-danger';
            }else if($data['peminjaman']['status_peminjaman'] == 'acc'){
                $data['status_peminjaman'] = 'Diterima';
                $data['class_status_peminjaman'] = 'bg-success border-success';
            }
            return view('admin.detail_riwayat_peminjaman_alat', $data);
        }else{
            return redirect('/admin/alat/riwayat')->with(['error'=>'Peminjaman Alat tidak ditemukan']);
        }
    }
    public function aksi_peminjaman_alat(Request $request){
        $data = $request->all();
        $peminjamanAlat = PeminjamanAlat::where('peminjaman_alat_id', $data['id_peminjaman_alat'])->first();
        if($peminjamanAlat){
            if($data['status_peminjaman'] == 'acc'){
                $temp = PeminjamanAlat::where('tanggal_mulai', $peminjamanAlat['tanggal_mulai'])->where('alat_id', $peminjamanAlat['alat_id'])->where('status_peminjaman', 'acc')->get();
                $isValid = true;
                foreach ($temp as $i => $t) {
                    $wm1 = DateTime::createFromFormat('H:i:s', $peminjamanAlat['waktu_mulai']);
                    $ws1 = DateTime::createFromFormat('H:i:s', $peminjamanAlat['waktu_selesai']);
                    $wm2 = DateTime::createFromFormat('H:i:s', $t['waktu_mulai']);
                    $ws2 = DateTime::createFromFormat('H:i:s', $t['waktu_selesai']);
                    $total_alat = $peminjamanAlat->alat['alat_total'];
                    $qty1 = $peminjamanAlat['alat_total'];
                    $qty2 = $t['alat_total'];
                    if($wm1 >= $ws2){
                        $isValid = true;
                    }else if($wm1 < $wm2 && $ws1 <= $wm2){ 
                        $isValid = true;
                    }else{
                        if($total_alat - $qty2 >= $qty1){
                            $isValid = true;
                        }else{
                            $isValid = false;
                            break;
                        }
                    }
                    
                    // if($wm1 >= $ws2 || $ws1 <= $wm2 ){
                    //     $isValid = true;
                    // }else if($wm1 >= $wm2 || $wm1 < $ws2){
                    //     if($total_alat - $qty2 >= $qty1){
                    //         $isValid = true;
                    //     }else{
                    //         $isValid = false;
                    //         break;
                    //     }
                    // }else{
                    //     break;
                    // }
                }
                if($isValid){
                    $peminjamanAlat->status_peminjaman = 'acc';
                    $boolPeminjamaAlat = $peminjamanAlat->save();
                    if($boolPeminjamaAlat){
                        return redirect('/admin/alat/peminjaman/' . $peminjamanAlat->peminjaman_alat_id)->with(['success'=>'Peminjaman Alat berhasil disetujui']);
                    }else{
                        return redirect('/admin/alat/peminjaman/' . $peminjamanAlat->peminjaman_alat_id)->with(['error'=>'Peminjaman Alat tidak gagal disetujui. Silakan coba lagi']);
                    }
                }else{
                    return redirect('/admin/alat/peminjaman/' . $peminjamanAlat->peminjaman_alat_id)->with(['error'=>'Peminjaman Alat tidak dapat disetujui karena sedang digunakan untuk kegiatan lain']);
                }
            }else{
                $peminjamanAlat->status_peminjaman = $data['status_peminjaman'];
                $boolPeminjamaAlat = $peminjamanAlat->save();
                if($boolPeminjamaAlat){
                    return redirect('/admin/alat/peminjaman/' . $peminjamanAlat->peminjaman_alat_id)->with(['success'=>'Peminjaman Alat berhasil diubah']);
                }else{
                    return redirect('/admin/alat/peminjaman/' . $peminjamanAlat->peminjaman_alat_id)->with(['error'=>'Peminjaman Alat gagal diubah']);
                }
            }
        }else{
            return redirect('/admin/alat')->with(['error'=>'Peminjaman Alat tidak ditemukan']);
        }
    }
    public function add_alat(Request $request){
        $data = $request->all();
        $fileFotoAlat = 'Foto ' . $data['alat_nama'] . '.' . $request->path->extension();  
        $request->path->move(public_path('img/alat/'), $fileFotoAlat);
        $alat = Alat::create([
            'alat_nama' => $data['alat_nama'], 
            'alat_keterangan' => $data['alat_keterangan'], 
            'alat_total' => $data['alat_total'], 
            'path' => $fileFotoAlat
        ]);
        if($alat){
            return redirect('/admin/alat/detail/' . $alat->alat_id)->with(['success'=>'Alat berhasil ditambahkan']);
        }else{
            return redirect('/admin/alat')->with(['error'=>'Alat gagal ditambahkan']);
        }
    }
    public function update_alat(Request $request){
        $data = $request->all();
        $alat = Alat::where('alat_id', $data['id_alat'])->first();
        if($alat){
            if(isset($data['path'])){
                $fileFotoAlat = 'Foto ' . $data['alat_nama'] . '.' . $request->path->extension();  
                $request->path->move(public_path('img/alat/'), $fileFotoAlat);
                $alat->path = $fileFotoAlat;
            }
            $alat->alat_nama = $data['alat_nama'];
            $alat->alat_keterangan = $data['alat_keterangan'];
            $alat->alat_total = $data['alat_total'];
            $boolAlat = $alat->save();
            if($boolAlat){
                return redirect('/admin/alat/detail/' . $alat->alat_id)->with(['success'=>'Alat berhasil diperbaharui']);
            }else{
                return redirect('/admin/alat/detail/' . $alat->alat_id)->with(['error'=>'Alat gagal diperbaharui']);
            }
        }else{
            return redirect('/admin/alat')->with(['error'=>'Alat tidak ditemukan']);
        }
    }
    public function delete_alat(Request $request){
        $data = $request->all();
        $peminjaman_alat = PeminjamanAlat::where('alat_id', $data['id_alat'])->get();
        if(count($peminjaman_alat)){
            return redirect('/admin/alat')->with(['error'=>'Alat gagal dihapus karena sudah ada data peminjaman']);
        }else{
            $boolPR = PeminjamanAlat::where('alat_id', $data['id_alat'])->delete();
            $boolAlat = Alat::where('alat_id', $data['id_alat'])->delete();
            return redirect('/admin/alat')->with(['success'=>'Alat berhasil dihapus']);
        }
    }



    // public function peminjaman(){
    //     $data = [];
    //     $data['page'] = 'peminjaman';
    //     $data['peminjamans'] = PeminjamanRuang::where('tanggal_mulai', '>=', date('Y-m-d'))->get();
    //     return view('admin.peminjaman', $data);
    // }

    // public function history_peminjaman(){
    //     $data = [];
    //     $data['page'] = 'history_peminjaman';
    //     $data['peminjamans'] = PeminjamanRuang::where('tanggal_mulai', '<', date('Y-m-d'))->get();
    //     return view('admin.history_peminjaman', $data);
    // }

    // public function daftar_ruangan(){
    //     $data = [];
    //     $data['page'] = 'daftar_ruangan';
    //     $data['ruangs'] = Ruang::all();
    //     return view('admin.daftar_ruangan', $data);
    // }

    // public function detail_ruang($id){
    //     $data = [];
    //     $data['page'] = 'daftar_ruangan';
    //     $data['ruang'] = Ruang::where('id_ruang', $id)->first();
    //     if($data['ruang']){
    //         return view('admin.detail_ruang', $data);
    //     }else{
    //         return redirect()->route('admin.daftar_ruangan');
    //     }
    // }

    // public function daftar_alat(){
    //     $data = [];
    //     $data['page'] = 'daftar_alat';
    //     $data['alats'] = Alat::all();
    //     return view('admin.daftar_alat', $data);
    // }

    // public function detail_alat($id){
    //     $data = [];
    //     $data['page'] = 'daftar_alat';
    //     $data['alat'] = Alat::where('id_alat', $id)->first();
    //     if($data['alat']){
    //         return view('admin.detail_alat', $data);
    //     }else{
    //         return redirect()->route('admin.daftar_alat');
    //     }
    // }

    // public function detail_pengajuan($id){
    //     $data = [];
    //     $data['page'] = 'peminjaman';
    //     $data['ruangs'] = Ruang::all();
    //     $data['pengajuan'] = PeminjamanRuang::where('id_peminjaman_ruang', $id)->first();
    //     if($data['pengajuan']){
    //         $data['isEditable'] = false;
    //         return view('admin.detail_peminjaman_ruang', $data);
    //     }else{
    //         return redirect()->route('admin.peminjaman');
    //     }
    // }

    // public function detail_history_pengajuan($id){
    //     $data = [];
    //     $data['page'] = 'history_peminjaman';
    //     $data['ruangs'] = Ruang::all();
    //     $data['pengajuan'] = PeminjamanRuang::where('id_peminjaman_ruang', $id)->first();
    //     if($data['pengajuan']){
    //         $data['isEditable'] = false;
    //         return view('admin.detail_history_peminjaman_ruang', $data);
    //     }else{
    //         return redirect()->route('admin.history_peminjaman');
    //     }
    // }

    // public function aksi_pengajuan_ruang(Request $request){
    //     $temp = $request->all();
    //     $pengajuan = PeminjamanRuang::where('id_peminjaman_ruang', $temp['id_peminjaman_ruang'])->first();
    //     if($pengajuan){
    //         $pengajuan->status_peminjaman = $temp['status_peminjaman'];
    //         $pengajuan->save();
    //         return redirect('/admin/detail_pengajuan/'.$temp['id_peminjaman_ruang']);
    //     }else{
    //         return redirect()->route('admin.peminjaman');
    //     }
    // }
}