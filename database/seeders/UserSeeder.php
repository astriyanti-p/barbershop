<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Barbershop',
            'username' => 'admin001',
            'email' => 'admin@barber.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => true,
        ]);

        User::create([
            'name' => 'Budi Barber',
            'username' => 'barber01',
            'email' => 'budi@barber.com',
            'password' => Hash::make('password'),
            'role' => 'barber',
            'phone' => '081234567890',
            'status' => true,
        ]);

        User::create([
            'name' => 'Andi Customer',
            'username' => 'cust0001',
            'email' => 'andi@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '089876543210',
            'status' => true,
        ]);
    }
}