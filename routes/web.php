<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/daftar/alat', [HomeController::class, 'daftar_alat'])->name('home.daftar_alat');
Route::get('/daftar/ruang', [HomeController::class, 'daftar_ruang'])->name('home.daftar_ruang');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
    // URL: /admin/
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/update', [AdminController::class, 'update_profile'])->name('admin.update_profile');
    Route::post('/password/update', [AdminController::class, 'update_password'])->name('admin.update_password');

    // [Ruang]
    Route::get('/ruang', [AdminController::class, 'daftar_ruang'])->name('admin.daftar_ruang');
    Route::get('/ruang/add', [AdminController::class, 'tambah_ruang'])->name('admin.tambah_ruang');
    Route::get('/ruang/detail/{id_ruang}', [AdminController::class, 'detail_ruang'])->name('admin.detail_ruang');
    Route::get('/ruang/peminjaman', [AdminController::class, 'daftar_peminjaman_ruang'])->name('admin.daftar_peminjaman_ruang');
    Route::get('/ruang/peminjaman/{id_peminjaman_ruang}', [AdminController::class, 'detail_peminjaman_ruang'])->name('admin.detail_peminjaman_ruang');
    Route::get('/ruang/riwayat', [AdminController::class, 'riwayat_peminjaman_ruang'])->name('admin.riwayat_peminjaman_ruang');
    Route::get('/ruang/riwayat/{id_peminjaman_ruang}', [AdminController::class, 'detail_riwayat_peminjaman_ruang'])->name('admin.detail_riwayat_peminjaman_ruang');
    Route::post('/ruang/aksi', [AdminController::class, 'aksi_peminjaman_ruang'])->name('admin.aksi_peminjaman_ruang');
    Route::post('/ruang/add', [AdminController::class, 'add_ruang'])->name('admin.add_ruang');
    Route::post('/ruang/update', [AdminController::class, 'update_ruang'])->name('admin.update_ruang');
    Route::post('/ruang/delete', [AdminController::class, 'delete_ruang'])->name('admin.delete_ruang');

    // [Alat]
    Route::get('/alat', [AdminController::class, 'daftar_alat'])->name('admin.daftar_alat');
    Route::get('/alat/add', [AdminController::class, 'tambah_alat'])->name('admin.tambah_alat');
    Route::get('/alat/detail/{id_alat}', [AdminController::class, 'detail_alat'])->name('admin.detail_alat');
    Route::get('/alat/peminjaman', [AdminController::class, 'daftar_peminjaman_alat'])->name('admin.daftar_peminjaman_alat');
    Route::get('/alat/peminjaman/{id_peminjaman_alat}', [AdminController::class, 'detail_peminjaman_alat'])->name('admin.detail_peminjaman_alat');
    Route::get('/alat/riwayat', [AdminController::class, 'riwayat_peminjaman_alat'])->name('admin.riwayat_peminjaman_alat');
    Route::get('/alat/riwayat/{id_peminjaman_alat}', [AdminController::class, 'detail_riwayat_peminjaman_alat'])->name('admin.detail_riwayat_peminjaman_alat');
    Route::post('/alat/aksi', [AdminController::class, 'aksi_peminjaman_alat'])->name('admin.aksi_peminjaman_alat');
    Route::post('/alat/add', [AdminController::class, 'add_alat'])->name('admin.add_alat');
    Route::post('/alat/update', [AdminController::class, 'update_alat'])->name('admin.update_alat');
    Route::post('/alat/delete', [AdminController::class, 'delete_alat'])->name('admin.delete_alat');
});

Route::group(['prefix' => 'pengguna', 'middleware' => 'is_pengguna'], function () {
    // URL: /pengguna/
    Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/profile', [PenggunaController::class, 'profile'])->name('pengguna.profile');
    Route::post('/profile/update', [PenggunaController::class, 'update_profile'])->name('pengguna.update_profile');
    Route::post('/password/update', [PenggunaController::class, 'update_password'])->name('pengguna.update_password');

    // [Ruang]
    Route::get('/ruang', [PenggunaController::class, 'daftar_peminjaman_ruang'])->name('pengguna.daftar_peminjaman_ruang');
    Route::get('/ruang/peminjaman/detail/{id_peminjaman_ruang}', [PenggunaController::class, 'detail_peminjaman_ruang'])->name('pengguna.detail_peminjaman_ruang');
    Route::get('/ruang/riwayat', [PenggunaController::class, 'riwayat_peminjaman_ruang'])->name('pengguna.riwayat_peminjaman_ruang');
    Route::get('/ruang/riwayat/{id_peminjaman_ruang}', [PenggunaController::class, 'detail_riwayat_peminjaman_ruang'])->name('pengguna.detail_riwayat_peminjaman_ruang');
    Route::get('/ruang/peminjaman/add', [PenggunaController::class, 'tambah_peminjaman_ruang'])->name('pengguna.tambah_peminjaman_ruang');
    Route::post('/ruang/peminjaman/add', [PenggunaController::class, 'add_peminjaman_ruang'])->name('pengguna.add_peminjaman_ruang');
    Route::post('/ruang/peminjaman/update', [PenggunaController::class, 'update_peminjaman_ruang'])->name('pengguna.update_peminjaman_ruang');
    Route::post('/ruang/peminjaman/delete', [PenggunaController::class, 'delete_peminjaman_ruang'])->name('pengguna.delete_peminjaman_ruang');

    // [Alat]
    Route::get('/alat', [PenggunaController::class, 'daftar_peminjaman_alat'])->name('pengguna.daftar_peminjaman_alat');
    Route::get('/alat/peminjaman/detail/{id_peminjaman_ruang}', [PenggunaController::class, 'detail_peminjaman_alat'])->name('pengguna.detail_peminjaman_ruang');
    Route::get('/alat/riwayat', [PenggunaController::class, 'riwayat_peminjaman_alat'])->name('pengguna.riwayat_peminjaman_alat');
    Route::get('/alat/riwayat/{id_peminjaman_alat}', [PenggunaController::class, 'detail_riwayat_peminjaman_alat'])->name('pengguna.detail_riwayat_peminjaman_alat');
    Route::get('/alat/peminjaman/add', [PenggunaController::class, 'tambah_peminjaman_alat'])->name('pengguna.tambah_peminjaman_alat');
    Route::post('/alat/peminjaman/add', [PenggunaController::class, 'add_peminjaman_alat'])->name('pengguna.add_peminjaman_alat');
    Route::post('/alat/peminjaman/update', [PenggunaController::class, 'update_peminjaman_alat'])->name('pengguna.update_peminjaman_alat');
    Route::post('/alat/peminjaman/delete', [PenggunaController::class, 'delete_peminjaman_alat'])->name('pengguna.delete_peminjaman_alat');

});