<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'روايات وأدب' => 'أعمال روائية وأدبية خالدة ومعاصرة تغوص في أعماق النفس البشرية والمجتمع.',
            'فانتازيا وخيال' => 'قصص ملحمية مليئة بالسحر، الأساطير، والعوالم الخيالية المدهشة.',
            'غموض وجريمة' => 'روايات بوليسية مشوقة تدور حول حل الألغاز وكشف الأسرار الغامضة.',
            'إثارة وتشويق' => 'أحداث سريعة ومليئة بالتوتر والمفاجآت التي تحبس الأنفاس حتى الصفحة الأخيرة.',
            'تاريخ وحضارات' => 'كتب توثق الأحداث التاريخية، سير الحضارات، والتحليلات العميقة للماضي.',
            'تطوير الذات' => 'كتب عملية تهدف إلى بناء العادات الإيجابية، رفع الإنتاجية، وتطوير المهارات.',
            'سير ومذكرات' => 'قصص واقعية تروي تجارب ملهمة وحياة شخصيات بارزة في التاريخ والواقع.',
            'علوم وتكنولوجيا' => 'مؤلفات مبسطة ومتخصصة تستكشف الاكتشافات العلمية والتطور التكنولوجي.',
        ];

        $name = fake()->unique()->randomElement(array_keys($categories));

        return [
            'category_name' => $name,
            'description' => fn(array $attributes) => $categories[$attributes['category_name']] ?? 'قسم متنوع يضم نخبة من الكتب المميزة.',
            'image' => 'https://picsum.photos' . fake()->unique()->numberBetween(1, 5000) . '/600/400',
        ];
    }
}