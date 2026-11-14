<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = [
            'عمّان',
            'إربد',
            'الزرقاء',
            'العقبة',
            'السلط',
            'مادبا',
            'الكرك',
            'جرش'
        ];

        $streets = [
            'شارع المدينة المنورة، عمارة رقم 14',
            'حي الجامعة، قرب البوابة الشمالية',
            'شارع مكة، مجمع الحسين التجاري',
            'منطقة عبدون، شارع الأميرة بسمة',
            'شارع الملك عبدالله الثاني، مقابل الحديقة',
            'حي النزهة، بجانب المسجد الكبير',
            'وسط البلد، شارع الهاشمي',
        ];

        $notes = [
            'يرجى الاتصال قبل الوصول بنصف ساعة.',
            'تسليم الطلب لحارس العمارة في حال عدم التواجد.',
            'تغليف الكتب بشكل جيد كهدية.',
            'التوصيل بعد الساعة الرابعة عصراً.',
            null,
            null,
        ];

        $status = fake()->randomElement([
            'pending',
            'processing',
            'shipped',
            'delivered',
            'cancelled',
            'returned',
        ]);

        return [
            'user_id' => User::factory(),
            'order_status' => $status,
            'total_price' => fake()->randomFloat(2, 12, 150),
            'note' => fake()->randomElement($notes),
            'shipping_address' => fake()->randomElement($streets),
            'city' => fake()->randomElement($cities),

            'recipient_phone' => function (array $attributes) {
                $user = User::find($attributes['user_id']);
                return $user?->phone_number ?? fake()->numerify('079#######');
            },

            'updated_by' => $status === 'pending'
                ? null
                : User::where('role', 'admin')->first()?->id,
        ];
    }
}