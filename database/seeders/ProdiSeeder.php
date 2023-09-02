<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodis = [
            [
                'prodi_nama' => 'Filsafat Keilahian',
                'prodi_fakultas' => 'Fakultas Teologi'
            ],
            [
                'prodi_nama' => 'Arsitektur',
                'prodi_fakultas' => 'Fakultas Arsitektur dan Desain'
            ],
            [
                'prodi_nama' => 'Desain Produk',
                'prodi_fakultas' => 'Fakultas Arsitektur dan Desain'
            ],
            [
                'prodi_nama' => 'Biologi',
                'prodi_fakultas' => 'Fakultas Bioteknologi'
            ],
            [
                'prodi_nama' => 'Manajemen',
                'prodi_fakultas' => 'Fakultas Bisnis'
            ],
            [
                'prodi_nama' => 'Akuntansi',
                'prodi_fakultas' => 'Fakultas Bisnis'
            ],
            [
                'prodi_nama' => 'Informatika',
                'prodi_fakultas' => 'Fakultas Teknologi Informasi'
            ],
            [
                'prodi_nama' => 'Sistem Informasi',
                'prodi_fakultas' => 'Fakultas Teknologi Informasi'
            ],
            [
                'prodi_nama' => 'Kedokteran',
                'prodi_fakultas' => 'Fakultas Kedokteran'
            ],
            [
                'prodi_nama' => 'Profesi Dokter',
                'prodi_fakultas' => 'Fakultas Kedokteran'
            ],
            [
                'prodi_nama' => 'Pendidikan Bahasa Inggris',
                'prodi_fakultas' => 'Fakultas Kependidikan dan Humaniora'
            ],
            [
                'prodi_nama' => 'Studi Humanitas',
                'prodi_fakultas' => 'Fakultas Kependidikan dan Humaniora'
            ],
        ];
        foreach ($prodis as $prodi) {
            Prodi::create($prodi);
        }
    }
}