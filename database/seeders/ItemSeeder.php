<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Clothing' => [
                'T-Shirt',
                'Shirt',
                'Jeans',
                'Trousers',
                'Shorts',
                'Dress',
                'Skirt',
                'Sweater',
            ],

            'Bedding' => [
                'Bed Sheet',
                'Pillowcase',
                'Duvet Cover',
                'Blanket',
                'Comforter',
                'Bedsheet Set',
            ],

            'Household Linen' => [
                'Curtain',
                'Tablecloth',
                'Table Runner',
                'Fabric Napkin',
            ],

            'Towels' => [
                'Bath Towel',
                'Hand Towel',
                'Face Towel',
                'Bathrobe',
            ],

            'Formal Wear' => [
                'Suit',
                'Blazer',
                'Formal Shirt',
                'Evening Dress',
                'Tie',
            ],

            'Baby Clothes' => [
                'Baby Shirt',
                'Baby Trousers',
                'Baby Dress',
                'Baby Blanket',
                'Baby Romper',
            ],

            'Accessories' => [
                'Scarf',
                'Cap',
                'Hat',
                'Gloves',
            ],

            'Shoes' => [
                'Sneakers',
                'Canvas Shoes',
                'Sports Shoes',
            ],
        ];

        foreach ($items as $categoryName => $designations) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($designations as $designation) {
                Item::firstOrCreate([
                    'designation' => $designation,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
