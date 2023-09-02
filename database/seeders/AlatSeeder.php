<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alats = [
            [
                'alat_nama' => 'Proyektor',
                'alat_keterangan' => '',
                'alat_total' => 6,
                'path' => ''
            ],
            [
                'alat_nama' => 'TV',
                'alat_keterangan' => '',
                'alat_total' => 5,
                'path' => ''
            ],
            [
                'alat_nama' => 'Kabel HDMI',
                'alat_keterangan' => '',
                'alat_total' => 15,
                'path' => ''
            ],
            [
                'alat_nama' => 'Kabel VGA',
                'alat_keterangan' => '',
                'alat_total' => 5,
                'path' => ''
            ],
            [
                'alat_nama' => 'Meja Lipat',
                'alat_keterangan' => '',
                'alat_total' => 3,
                'path' => ''
            ],
            [
                'alat_nama' => 'Speaker',
                'alat_keterangan' => '',
                'alat_total' => 4,
                'path' => ''
            ],
        ];
        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }
}