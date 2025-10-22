<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'hubert@gmail.com'],
            [
                'name' => 'Hubert',
                'password' => bcrypt('12345678'),
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['email' => 'rio@gmail.com'],
            [
                'name' => 'Rio',
                'password' => bcrypt('12345678'),
                'role' => 'user',
            ]
        );
    }
}
