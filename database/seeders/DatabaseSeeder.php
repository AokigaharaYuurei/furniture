<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['login' => 'administrator'],
            [
                'firstname' => 'Admin',
                'middlename' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin2025'),
                'tel' => '+79999999999',
                'role' => 'admin',
            ]
        );
    }
}