<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;



class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeCustomers = User::where('role', 'customer')
            ->where('status', 'active')
            ->take(8)
            ->get();

        foreach ($activeCustomers as $user) {
            Seller::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}