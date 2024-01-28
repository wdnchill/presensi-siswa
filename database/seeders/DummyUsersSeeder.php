<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456'),
                'imguser' => 'christy.jpg' // Nama berkas gambar di penyimpanan
            ],
            [
                'name' => 'guru',
                'email' => 'guru@gmail.com',
                'role' => 'guru',
                'password' => bcrypt('123456'),
                'imguser' => 'Marsha.jpeg' // Nama berkas gambar di penyimpanan
            ],
            [
                'name' => 'walas',
                'email' => 'walas@gmail.com',
                'role' => 'walas',
                'password' => bcrypt('123456'),
                'imguser' => 'we.jpeg' // Nama berkas gambar di penyimpanan
            ],
        ];

        foreach ($userData as $key => $val) {
          User::create($val);
        }
    }
}