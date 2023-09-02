<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            
        ];
        User::create([
            'name' => 'Alpha',
            'username' => 'alpha',
            'email' => 'alpha@gmail.com',
            'password' => bcrypt('123123123'),
            'is_admin' => 1
        ]);
        $usr = User::create([
                    'name' => 'Vania',
                    'username' => 'vania',
                    'email' => 'vania@gmail.com',
                    'password' => bcrypt('12345678'),
                    'is_admin' => 0
                ]);
        Mahasiswa::create([
            'mahasiswa_nama' => $usr->name, 
            'user_id' => $usr->user_id,
            'mahasiswa_nim' => '0', 
            'mahasiswa_prodi' => '1', 
            'mahasiswa_angkatan' => '2023',
        ]);
    }
}