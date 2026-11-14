<?php

namespace Database\Factories;

use App\Models\seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $storeNames = [
            'مكتبة الشروق',
            'دار الآداب للنشر',
            'مكتبة جرير',
            'مكتبة العبيكان',
            'دار التنوير',
            'مكتبة مدبولي',
            'عصير الكتب',
            'مكتبة صفحات',
            'دار الساقي',
            'مكتبة الأمل',
            'دار الشروق',
            'مكتبة الرشد',
            'وراقون للكتب',
            'مكتبة ألف',
            'دار المعارف',
            'مكتبة الحرية',
            'بيت الحكمة للكتب',
            'مكتبة الفكر',
            'دار الكرمة',
            'مكتبة النور',
        ];

        return [
            'user_id' => User::factory()->state([
                'role' => 'customer',
                'status' => 'active',
            ]),
            'store_name' => fake()->unique()->randomElement($storeNames),
        ];
    }
}