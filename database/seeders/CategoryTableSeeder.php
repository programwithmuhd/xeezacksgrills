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
        ]);

        Category::create([
            'name' => 'Salad',
        ]);

        Category::create([
            'name' => 'Cold Appetizers',
        ]);

        Category::create([
            'name' => 'Hot Appetizers',
        ]);

        Category::create([
            'name' => 'Meat',
        ]);

        Category::create([
            'name' => 'Chicken Dishes',
        ]);
    }
}
