<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Clothing',
                'description' => 'Everyday clothing such as shirts, trousers and dresses.',
            ],
            [
                'name' => 'Bedding',
                'description' => 'Bed sheets, pillowcases, blankets and duvet covers.',
            ],
            [
                'name' => 'Household Linen',
                'description' => 'Household fabrics such as curtains and tablecloths.',
            ],
            [
                'name' => 'Towels',
                'description' => 'Bath towels, hand towels and face towels.',
            ],
            [
                'name' => 'Formal Wear',
                'description' => 'Formal clothing requiring careful cleaning and ironing.',
            ],
            [
                'name' => 'Baby Clothes',
                'description' => 'Baby clothing and other small washable garments.',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Washable accessories such as scarves and caps.',
            ],
            [
                'name' => 'Shoes',
                'description' => 'Washable footwear requiring cleaning services.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
