<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'user_name' => '710مصطفى',
            'email' => 'admin@bookstore.com',
            'phone_number' => '0790000000',
            'role' => 'admin',
            'status' => 'active',
            'password' => Hash::make('12345678'),
        ]);

        User::factory(15)->create([
            'role' => 'customer',
            'status' => 'active',
        ]);

        User::factory(3)->create([
            'role' => 'customer',
            'status' => 'de_active',
        ]);
    }
}