<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Ruang;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlat;
use App\Models\PeminjamanRuang;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data = [];
        $data['page'] = 'index';
        return view('pengguna.index', $data);
    }
    public function profile(){
        $data = [];
        $data['user'] = User::where('user_id', auth()->user()->user_id)->first();
        $data['isMahasiswa'] = Mahasiswa::where('user_id', auth()->user()->user_id)->first();
        if($data['isMahasiswa']){
            $data['mahasiswa'] = Mahasiswa::where('user_id', auth()->user()->user_id)->first();
        }else{
            $data['dosen'] = Dosen::where('user_id', auth()->user()->user_id)->first();
        }
        $data['prodis'] = Prodi::all();
        return view('pengguna.profile', $data);
    }
    public function update_profile(Request $request){
        $data = $request->all();
        $user = User::where('user_id', auth()->user()->user_id)->first();
        if($user){
            $user->name = $data['name'];
            $user->email = $data['email'];
            $boolUser = $user->save();
            $isMahasiswa = Mahasiswa::where('user_id', auth()->user()->user_id)->first();
            if($isMahasiswa){
                $mahasiswa = Mahasiswa::where('user_id', auth()->user()->user_id)->first();
                $mahasiswa->mahasiswa_nama = $data['name'];
                $mahasiswa->mahasiswa_nim = $data['mahasiswa_nim'];
                $mahasiswa->mahasiswa_prodi = $data['mahasiswa_prodi'];
                $mahasiswa->mahasiswa_angkatan = $data['mahasiswa_angkatan'];
                $boolPengguna = $mahasiswa->save();
            }else{
                $dosen = Dosen::where('user_id', auth()->user()->user_id)->first();
                $dosen->dosen_nama = $data['name'];
                $dosen->dosen_nik = $data['dosen_nik'];
                $boolPengguna = $dosen->save();
            }
            if($boolUser || $boolPengguna){
                return redirect('/pengguna/profile')->with(['successInfo'=>'Berhasil memperbaharui profile']);
            }else{
                return redirect('/pengguna/profile')->with(['errorInfo'=>'Gagal memperbaharui profile']);
            }

        }else{
            return redirect()->route('pengguna.index');
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
                return redirect('/pengguna/profile')->with(['successPW'=>'Berhasil memperbaharui password']);
            }else{
                return redirect('/pengguna/profile')->with(['errorPW'=>'Gagal memperbaharui password']);
            }
        }else{  
            return redirect()->back()->withErrors(['pwLama'=>'Password Lama tidak sesuai']);   
        }
    }
    public function daftar_peminjaman_ruang(){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['page'] = 'daftar_peminjaman_ruang';
        $data['peminjamanRuangs'] = PeminjamanRuang::where('user_id', $user_id)->where('tanggal_mulai', '>=', date('Y-m-d'))->orderBy('tanggal_mulai', 'DESC')->orderBy('waktu_mulai', 'ASC')->get();
        return view('pengguna.daftar_peminjaman_ruang', $data);
    }
    public function riwayat_peminjaman_ruang(){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['page'] = 'riwayat_peminjaman_ruang';
        $data['peminjamanRuangs'] = PeminjamanRuang::where('user_id', $user_id)->where('tanggal_mulai', '<', date('Y-m-d'))->orderBy('tanggal_mulai', 'DESC')->orderBy('waktu_mulai', 'ASC')->get();
        return view('pengguna.riwayat_peminjaman_ruang', $data);
    }
    public function daftar_peminjaman_alat(){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['page'] = 'daftar_peminjaman_alat';
        $data['peminjamanAlats'] = PeminjamanAlat::where('user_id', $user_id)->where('tanggal_mulai', '>=', date('Y-m-d'))->orderBy('tanggal_mulai', 'DESC')->orderBy('waktu_mulai', 'ASC')->get();
        return view('pengguna.daftar_peminjaman_alat', $data);
    }
    public function riwayat_peminjaman_alat(){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['page'] = 'riwayat_peminjaman_alat';
        $data['peminjamanAlats'] = PeminjamanAlat::where('user_id', $user_id)->where('tanggal_mulai', '<', date('Y-m-d'))->orderBy('tanggal_mulai', 'DESC')->orderBy('waktu_mulai', 'ASC')->get();
        return view('pengguna.riwayat_peminjaman_alat', $data);
    }
    
    public function tambah_peminjaman_ruang(){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['page'] = 'daftar_peminjaman_ruang';
        $data['user'] = User::where('user_id', $user_id)->first();
        $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
        if($data['isMahasiswa']){
            $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
        }else{
            $data['dosen'] = Dosen::where('user_id', $user_id)->first();
        }
        $data['ruangs'] = Ruang::all();
        return view('pengguna.tambah_peminjaman_ruang', $data);
    }
    public function add_peminjaman_ruang(Request $request){
        $data = $request->all();
        $fileNameSurat = 'Surat Penganter Peminjaman ' . $data['nama_kegiatan'] . '.' . $request->path_dokumen->extension();  
        $request->path_dokumen->move(public_path('surat/ruangan/'), $fileNameSurat);
        $peminjamanRuang = PeminjamanRuang::create([
            'ruang_id' => $data['ruang_id'], 
            'user_id' =>  auth()->user()->user_id,
            'nama_kegiatan' => $data['nama_kegiatan'], 
            'pj_kegiatan' => $data['pj_kegiatan'], 
            'deskripsi_kegiatan' => $data['deskripsi_kegiatan'], 
            'tanggal_mulai' => $data['tanggal_mulai'], 
            'waktu_mulai' => $data['waktu_mulai'], 
            'tanggal_selesai' => $data['tanggal_mulai'], 
            'waktu_selesai' => $data['waktu_selesai'],
            'path_dokumen' => $fileNameSurat, 
            'status_peminjaman' => 'proses'
        ]);
        if($peminjamanRuang){
            return redirect('/pengguna/ruang/peminjaman/detail/' . $peminjamanRuang->peminjaman_ruang_id)->with(['success'=>'Peminjaman Ruangan berhasil ditambahkan']);
        }else{
            return redirect('/pengguna/ruang')->with(['error'=>'Peminjaman Ruangan gagal ditambahkan']);
        }
    }
    public function detail_peminjaman_ruang($id_peminjaman_ruang){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['peminjaman'] = PeminjamanRuang::where('peminjaman_ruang_id', $id_peminjaman_ruang)->first();
        if($data['peminjaman']){
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
            $data['isEditable'] = ($data['peminjaman']['status_peminjaman'] == 'proses' && $isDateValid);
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
            return view('pengguna.detail_peminjaman_ruang', $data);
        }else{
            return redirect('/pengguna/ruang')->with(['error'=>'Peminjaman Ruangan tidak ditemukan']);
        }
    }
    public function detail_riwayat_peminjaman_ruang($id_peminjaman_ruang){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['peminjaman'] = PeminjamanRuang::where('peminjaman_ruang_id', $id_peminjaman_ruang)->first();
        if($data['peminjaman']){
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
            return view('pengguna.detail_riwayat_peminjaman_ruang', $data);
        }else{
            return redirect('/pengguna/ruang/riwayat')->with(['error'=>'Riwayat Peminjaman Ruangan tidak ditemukan']);
        }
    }
    public function update_peminjaman_ruang(Request $request){
        $data = $request->all();
        $peminjamanRuang = PeminjamanRuang::where('peminjaman_ruang_id', $data['id_peminjaman_ruang'])->first();
        if($peminjamanRuang){
            $peminjamanRuang->ruang_id = $data['ruang_id'];
            $peminjamanRuang->nama_kegiatan = $data['nama_kegiatan'];
            $peminjamanRuang->pj_kegiatan = $data['pj_kegiatan'];
            $peminjamanRuang->tanggal_mulai = $data['tanggal_mulai'];
            $peminjamanRuang->waktu_mulai = $data['waktu_mulai'];
            $peminjamanRuang->tanggal_selesai = $data['tanggal_mulai'];
            $peminjamanRuang->waktu_selesai = $data['waktu_selesai'];
            $peminjamanRuang->deskripsi_kegiatan = $data['deskripsi_kegiatan'];
            if(isset($data['path_dokumen'])){
                $fileNameSurat = 'Surat Penganter Peminjaman ' . $data['nama_kegiatan'] . '.' . $request->path_dokumen->extension();  
                $request->path_dokumen->move(public_path('surat/ruangan/'), $fileNameSurat);
                $peminjamanRuang->path_dokumen = $fileNameSurat;
            }
            $boolPeminjamanRuang = $peminjamanRuang->save();
            if($boolPeminjamanRuang){
                return redirect('/pengguna/ruang/peminjaman/detail/' . $peminjamanRuang->peminjaman_ruang_id)->with(['success'=>'Peminjaman Ruangan berhasil diupdate']);
            }else{
                return redirect('/pengguna/ruang/peminjaman/detail/' . $peminjamanRuang->peminjaman_ruang_id)->with(['error'=>'Peminjaman Ruangan gagal diupdate']);
            }
        }else{
            return redirect('/pengguna/ruang')->with(['error'=>'Peminjaman Ruangan tidak ditemukan']);
        }
    }

    public function tambah_peminjaman_alat(){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['page'] = 'daftar_peminjaman_alat';
        $data['user'] = User::where('user_id', $user_id)->first();
        $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
        if($data['isMahasiswa']){
            $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
        }else{
            $data['dosen'] = Dosen::where('user_id', $user_id)->first();
        }
        $data['alats'] = Alat::all();
        return view('pengguna.tambah_peminjaman_alat', $data);
    }
    public function add_peminjaman_alat(Request $request){
        $data = $request->all();
        $fileNameSurat = 'Surat Pengantar Peminjaman ' . $data['nama_kegiatan'] . '.' . $request->path_dokumen->extension();  
        $request->path_dokumen->move(public_path('surat/alat/'), $fileNameSurat);
        $peminjamanAlat = PeminjamanAlat::create([
            'alat_id' => $data['alat_id'], 
            'user_id' =>  auth()->user()->user_id,
            'nama_kegiatan' => $data['nama_kegiatan'], 
            'pj_kegiatan' => $data['pj_kegiatan'], 
            'deskripsi_kegiatan' => $data['deskripsi_kegiatan'], 
            'alat_total' => $data['qty'], 
            'tanggal_mulai' => $data['tanggal_mulai'], 
            'waktu_mulai' => $data['waktu_mulai'], 
            'tanggal_selesai' => $data['tanggal_mulai'], 
            'waktu_selesai' => $data['waktu_selesai'],
            'path_dokumen' => $fileNameSurat, 
            'status_peminjaman' => 'proses'
        ]);
        if($peminjamanAlat){
            return redirect('/pengguna/alat/peminjaman/detail/' . $peminjamanAlat->peminjaman_alat_id)->with(['success'=>'Peminjaman Alat berhasil ditambahkan']);
        }else{
            return redirect('/pengguna/alat')->with(['error'=>'Peminjaman Alat gagal ditambahkan']);
        }
    }
    public function detail_peminjaman_alat($id_peminjaman_alat){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['peminjaman'] = PeminjamanAlat::where('peminjaman_alat_id', $id_peminjaman_alat)->first();
        if($data['peminjaman']){
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
            $data['isEditable'] = ($data['peminjaman']['status_peminjaman'] == 'proses' && $isDateValid);
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
            return view('pengguna.detail_peminjaman_alat', $data);
        }else{
            return redirect('/pengguna/alat')->with(['error'=>'Peminjaman Alat tidak ditemukan']);
        }
    }
    public function detail_riwayat_peminjaman_alat($id_peminjaman_alat){
        $user_id = auth()->user()->user_id;
        $data = [];
        $data['peminjaman'] = PeminjamanAlat::where('peminjaman_alat_id', $id_peminjaman_alat)->first();
        if($data['peminjaman']){
            $data['page'] = 'riwayat_peminjaman_alat';
            $data['user'] = User::where('user_id', $user_id)->first();
            $data['isMahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            if($data['isMahasiswa']){
                $data['mahasiswa'] = Mahasiswa::where('user_id', $user_id)->first();
            }else{
                $data['dosen'] = Dosen::where('user_id', $user_id)->first();
            }
            $data['alats'] = Alat::all();
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
            return view('pengguna.detail_riwayat_peminjaman_alat', $data);
        }else{
            return redirect('/pengguna/alat/riwayat')->with(['error'=>'Riwayat Peminjaman Alat tidak ditemukan']);
        }
    }
    public function update_peminjaman_alat(Request $request){
        $data = $request->all();
        $peminjamanAlat = PeminjamanAlat::where('peminjaman_alat_id', $data['id_peminjaman_alat'])->first();
        if($peminjamanAlat){
            $peminjamanAlat->alat_id = $data['alat_id'];
            $peminjamanAlat->nama_kegiatan = $data['nama_kegiatan'];
            $peminjamanAlat->pj_kegiatan = $data['pj_kegiatan'];
            $peminjamanAlat->tanggal_mulai = $data['tanggal_mulai'];
            $peminjamanAlat->waktu_mulai = $data['waktu_mulai'];
            $peminjamanAlat->tanggal_selesai = $data['tanggal_mulai'];
            $peminjamanAlat->waktu_selesai = $data['waktu_selesai'];
            $peminjamanAlat->deskripsi_kegiatan = $data['deskripsi_kegiatan'];
            $peminjamanAlat->alat_total = $data['qty'];
            if(isset($data['path_dokumen'])){
                $fileNameSurat = 'Surat Pengantar Peminjaman ' . $data['nama_kegiatan'] . '.' . $request->path_dokumen->extension();  
                $request->path_dokumen->move(public_path('surat/alat/'), $fileNameSurat);
                $peminjamanAlat->path_dokumen = $fileNameSurat;
            }
            $boolPeminjamanAlat = $peminjamanAlat->save();
            if($boolPeminjamanAlat){
                return redirect('/pengguna/alat/peminjaman/detail/' . $peminjamanAlat->peminjaman_alat_id)->with(['success'=>'Peminjaman Alat berhasil diupdate']);
            }else{
                return redirect('/pengguna/alat/peminjaman/detail/' . $peminjamanAlat->peminjaman_alat_id)->with(['error'=>'Peminjaman Alat gagal diupdate']);
            }
        }else{
            return redirect('/pengguna/alat')->with(['error'=>'Peminjaman Alat tidak ditemukan']);
        }
    }
}