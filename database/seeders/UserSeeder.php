<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'vilayatkhan07@gmail.com'],
            [
                'name' => 'Vilayat Khan',
                'password' => Hash::make('12345'),
                'email_verified_at' => now(),
            ]
        );
    }
}