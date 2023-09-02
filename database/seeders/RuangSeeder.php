<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruangs = [
            [
                'ruang_nama' => 'Ruang Gateway',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 3',
                'ruang_letak' => 'Agape Lt 3',
                'ruang_kapasitas' => 15,
            ],
            [
                'ruang_nama' => 'Ruang Firewall',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 3',
                'ruang_letak' => 'Agape Lt 3',
                'ruang_kapasitas' => 20,
            ],
            [
                'ruang_nama' => 'Ruang Kernel',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 3',
                'ruang_letak' => 'Agape Lt 3',
                'ruang_kapasitas' => 5,
            ],
            [
                'ruang_nama' => 'Ruang Hypertext',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 3',
                'ruang_letak' => 'Agape Lt 3',
                'ruang_kapasitas' => 5,
            ],
            [
                'ruang_nama' => 'Ruang Interface',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 3',
                'ruang_letak' => 'Agape Lt 3',
                'ruang_kapasitas' => 5,
            ],

            
            [
                'ruang_nama' => 'Lab MIS',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 4',
                'ruang_letak' => 'Agape Lt 4',
                'ruang_kapasitas' => 36,
            ],
            [
                'ruang_nama' => 'Lab AI',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 4',
                'ruang_letak' => 'Agape Lt 4',
                'ruang_kapasitas' => 20,
            ],
            [
                'ruang_nama' => 'Lab Mobile',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 4',
                'ruang_letak' => 'Agape Lt 4',
                'ruang_kapasitas' => 18,
            ],
            [
                'ruang_nama' => 'Lab Big Data',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 4',
                'ruang_letak' => 'Agape Lt 4',
                'ruang_kapasitas' => 20,
            ],
            [
                'ruang_nama' => 'Lab Multimedia',
                'ruang_keterangan' => '',
                'ruang_lab' => 'Lab 4',
                'ruang_letak' => 'Agape Lt 4',
                'ruang_kapasitas' => 5,
            ],
        ];
        foreach ($ruangs as $ruang) {
            Ruang::create($ruang);
        }
    }
}