<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $books = [
            [
                'category' => 'روايات وأدب',
                'title' => 'أولاد حارتنا',
                'author' => 'نجيب محفوظ',
                'publisher' => 'دار الشروق',
                'year' => 1959,
                'pages' => 552,
                'isbn' => '9789770916636',
                'desc' => 'رواية رمزية ملحمية تتناول الصراع الإنساني الأزلي بين الخير والشر والبحث عن العدالة.',
            ],
            [
                'category' => 'روايات وأدب',
                'title' => 'رجال في الشمس',
                'author' => 'غسان كنفاني',
                'publisher' => 'منشورات الرمال',
                'year' => 1963,
                'pages' => 106,
                'isbn' => '9789953894515',
                'desc' => 'رواية أدبية مؤثرة تروي رحلة ثلاثة لاجئين يبحثون عن حياة كريمة ومستقبل آمن.',
            ],
            [
                'category' => 'فانتازيا وخيال',
                'title' => 'أرض زيكولا',
                'author' => 'عمرو عبد الحميد',
                'publisher' => 'عصير الكتب',
                'year' => 2010,
                'pages' => 288,
                'isbn' => '9789776541078',
                'desc' => 'مغامرة خيالية مشوقة في أرض لا يتعامل أهلها بالنقود، بل بوحدات الذكاء.',
            ],
            [
                'category' => 'فانتازيا وخيال',
                'title' => 'يوتوبيا',
                'author' => 'أحمد خالد توفيق',
                'publisher' => 'دار ميريت',
                'year' => 2008,
                'pages' => 192,
                'isbn' => '9789773513993',
                'desc' => 'رواية ديستوبية تستشرف المستقبل وتصور الانقسام الطبقي الحاد في المجتمع.',
            ],
            [
                'category' => 'غموض وجريمة',
                'title' => 'الفيل الأزرق',
                'author' => 'أحمد مراد',
                'publisher' => 'دار الشروق',
                'year' => 2012,
                'pages' => 412,
                'isbn' => '9789770931677',
                'desc' => 'رحلة نفسية غامضة داخل أروقة مستشفى العباسية لكشف أسرار جريمة معقدة.',
            ],
            [
                'category' => 'إثارة وتشويق',
                'title' => 'تراب الماس',
                'author' => 'أحمد مراد',
                'publisher' => 'دار الشروق',
                'year' => 2010,
                'pages' => 384,
                'isbn' => '9789770928363',
                'desc' => 'قصة بوليسية مشوقة حول دفتر مذكرات غامض يكشف سلسلة من الجرائم الخفية.',
            ],
            [
                'category' => 'تطوير الذات',
                'title' => 'العادات الذرية',
                'author' => 'جيمس كلير',
                'publisher' => 'دار التنوير',
                'year' => 2018,
                'pages' => 320,
                'isbn' => '9780735211292',
                'desc' => 'دليل عملي لبناء العادات الجيدة والتخلص من العادات السيئة عبر تغييرات صغيرة مستمرة.',
            ],
            [
                'category' => 'تطوير الذات',
                'title' => 'فن اللامبالاة',
                'author' => 'مارك مانسون',
                'publisher' => 'دار التنوير',
                'year' => 2016,
                'pages' => 272,
                'isbn' => '9789953895789',
                'desc' => 'منهج غير تقليدي لعيش حياة هادئة من خلال التركيز على ما يستحق الاهتمام فعلاً.',
            ],
            [
                'category' => 'تاريخ وحضارات',
                'title' => 'مقدمة ابن خلدون',
                'author' => 'ابن خلدون',
                'publisher' => 'دار الفكر',
                'year' => 1377,
                'pages' => 680,
                'isbn' => '9789953130521',
                'desc' => 'العمل التأسيسي لعلم الاجتماع وفلسفة التاريخ ودراسة نشوء وسقوط الدول والحضارات.',
            ],
            [
                'category' => 'سير ومذكرات',
                'title' => 'الأيام',
                'author' => 'طه حسين',
                'publisher' => 'دار المعارف',
                'year' => 1929,
                'pages' => 440,
                'isbn' => '9789770276426',
                'desc' => 'سيرة ذاتية ملهمة تروي قصة كفاح عميد الأدب العربي منذ طفولته في القرية وحتى دراسته في الأزهر وفرنسا.',
            ],
            [
                'category' => 'علوم وتكنولوجيا',
                'title' => 'تاريخ موجز للزمان',
                'author' => 'ستيفن هوكينج',
                'publisher' => 'دار التنوير',
                'year' => 1988,
                'pages' => 256,
                'isbn' => '9780553380163',
                'desc' => 'شرح مبسط وممتع لأسرار الكون، الثقوب السوداء، الانفجار العظيم، وطبيعة الزمان والمكان.',
            ],
        ];

        $book = fake()->randomElement($books);


        $category = Category::where('category_name', $book['category'])->first()
            ?? Category::factory()->create(['category_name' => $book['category']]);

        return [
            'category_id' => $category->id,
            'seller_id' => Seller::factory(),
            'product_name' => $book['title'],
            'description' => $book['desc'],
            'price' => fake()->randomFloat(2, 5, 35),
            'stock' => fake()->numberBetween(10, 100),
            'isbn' => $book['isbn'],
            'author' => $book['author'],
            'publisher' => $book['publisher'],
            'published_year' => $book['year'],
            'pages' => $book['pages'],
        ];
    }
}