<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'id' => 1, 
            'name' => 'Kombucha1',
            'description' => 'Fermented teas with a variety of flavors.'
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Kombucha2',
            'description' => 'Second Category Fermented teas with a variety of flavors.'
        ]);
    }
}
