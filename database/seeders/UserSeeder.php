<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kendari Loker',
            'email' => 'admin@kendariloker.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone_number' => '081234567890',
        ]);

        User::create([
            'name' => 'HRD Tech Indo',
            'email' => 'hr@techindo.test',
            'password' => Hash::make('password123'),
            'role' => 'employer',
            'phone_number' => '081122334455',
        ]);

        User::create([
            'name' => 'Rekrutmen Maju Jaya',
            'email' => 'rekrutmen@majujaya.test',
            'password' => Hash::make('password123'),
            'role' => 'employer',
            'phone_number' => '089988776655',
        ]);
    }
}
