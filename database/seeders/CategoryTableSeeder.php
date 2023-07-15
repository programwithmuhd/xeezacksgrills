<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Soup',
            'slug' => 'Soup',
        ]);

        Category::create([
            'name' => 'Salad',
            'slug' => 'Salad',
        ]);

        Category::create([
            'name' => 'Cold Appetizers',
            'slug' => 'cold-appetizers',
        ]);

        Category::create([
            'name' => 'Hot Appetizers',
            'slug' => 'hot-appetizers',
        ]);

        Category::create([
            'name' => 'Meat',
            'slug' => 'meat',
        ]);

        Category::create([
            'name' => 'Chicken Dishes',
            'slug' => 'chicken-dishes',
        ]);
    }
}
