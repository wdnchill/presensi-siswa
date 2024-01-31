<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'imguser' => '',
            ],
            [
                'name' => 'guru',
                'email' => 'guru@gmail.com',
                'username' => 'guru',
                'password' => Hash::make('123456'),
                'role' => 'guru',
                'imguser' => '',
            ],
            [
                'name' => 'walas',
                'email' => 'walas@gmail.com',
                'username' => 'walas',
                'password' => Hash::make('123456'),
                'role' => 'walas',
                'imguser' => '',
            ],
        ];

        foreach ($userData as $userData) {
            User::create($userData);
        }
    }
}
