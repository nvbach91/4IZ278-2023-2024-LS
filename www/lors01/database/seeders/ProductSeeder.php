<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $category = Category::first(); // Ensure a category exists or create one if none

        if (!$category) {
            $category = Category::create([
                'name' => 'Default',
                'description' => 'Default category'
            ]);
        }

        Product::create([
            'id' => 1,
            'name' => 'Blue Kombucha',
            'description' => 'Osvěžující, lehce nasládlá a plná probiotik.',
            'price' => 499,
            'category_id' => 1,
            'stock' => 6,
            'image' => 'images/blue.png' 
        ]);
        Product::create([
            'id' => 2,
            'name' => 'Mystic Kombucha',
            'description' => 'Osvěžující, lehce nasládlá a plná probiotik. Výborná',
            'price' => 699,
            'category_id' => 1, 
            'stock' => 41,
            'image' => 'images/mystic.png' 
        ]);
        Product::create([
            'id' => 3,
            'name' => 'Green Kombucha',
            'description' => 'Nová edice s mnohem lepší chutí',
            'price' => 899,
            'category_id' => 2, 
            'stock' => 100,
            'image' => 'images/green.png' 
        ]);
        Product::create([
            'id' => 4,
            'name' => 'Holy Kombucha',
            'description' => 'Nová edice s mnohem lepší chutí',
            'price' => 999,
            'category_id' => 2, 
            'stock' => 10,
            'image' => 'images/holy.png' 
        ]);

    }
}
