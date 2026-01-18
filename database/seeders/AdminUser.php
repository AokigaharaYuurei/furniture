<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['login' => 'administrator'],
            [
                'firstname'=>'administrator',
                'middlename'=>'administratorovich',
                'lastname'=>'administratorov',
                'email'=>'admin@gmail.com',
                'password'=>\Illuminate\Support\Facades\Hash::make('admin2025'),
                'tel'=>'88005553535',
                'role'=>'admin',
            ]
        );
    }
}
