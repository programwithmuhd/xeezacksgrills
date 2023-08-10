<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'category_id' => 1,
            'name' => 'Lentil Soup Turkish Mercimek Homemade',
            'slug' => 'mixed-appetizers',
            'image' => '1_lent_soup.jpg',
            'description' => 'Vegetarian Red Lentil Soup Served with Lemon Served with Homemade Turkish Bread or Pita Bread',
            'price' => '2800.00',
        ]);

        Menu::create([
            'category_id' => 1,
            'name' => 'Chicken Soup Turkish Style Homemade',
            'slug' => 'chicken-soup',
            'image' => '2_lent_chicken_soup.jpg',
            'description' => 'Chicken Soup with Mixed Vegetables \n Served with Homemade Turkish Bread or Pita Bread',
            'price' => '2800.00',
        ]);

        Menu::create([
            'category_id' => 1,
            'name' => 'Turkish Choban Salatasi / Shepherd Salad',
            'slug' => 'salad',
            'image' => '1_shepheard_salad.jpg',
            'description' => 'Fresh Tomatoes, Green Peppers, Cucumbers, Onions. Parsley & Olive Oi] Lemon Juice Dressing. Served with Homemade Turkish Bread or Pita Bread. Add Cheese - NGN300.00. Add Any 1 Kebab - $10.95 .Add Falafel(5pcs) - NGN3000.',
            'price' => '4550.00',
        ]);

        Menu::create([
            'category_id' => 1,
            'name' => 'Turkish Mediterranean Salad',
            'slug' => 'salad',
            'image' => '3_nediterranean_salad.jpg',
            'description' => 'Mixed Greens, Fresh Tomatoes, Lettuce, Green Peppers, Red Peppers, Cucumbers, Onions, Parsley & Olive Oil Lemon Juice Dressing Served with Feta cheese.Served with Homemade Turkish Bread or Pita Bread',
            'price' => '3550.00',
        ]);
        
        Menu::create([
            'category_id' => 1,
            'name' => 'Mixed Appetizers(Any 4 choices)',
            'slug' => 'mixed-appetizers',
            'image' => '1_mix_cold_appetizers.jpg',
            'description' => 'Authentic Style Turkish Tzatziki Served with Homemade Turkish Bread or Pita Bread',
            'price' => '4550.00',
        ]);

        Menu::create([
            'category_id' => 2,
            'name' => 'Mixed Appetizers(Any 7 choices)',
            'slug' => 'mixed-appetizers',
            'image' => '2_authentic_turkish_appetizer.jpg',
            'description' => 'Authentic Style Turkish Tzatziki Served with Homemade Turkish Bread or Pita Bread',
            'price' => '5650.00',
        ]);
        Menu::create([
            'category_id' => 3,
            'name' => 'Mixed Appetizers(Any 7 choices) 1',
            'slug' => 'mixed-appetizers',
            'description' => 'Authentic Style Turkish Tzatziki Served with Homemade Turkish Bread or Pita Bread',
            'price' => '3500.00',
        ]);
        Menu::create([
            'category_id' => 3,
            'name' => 'Mixed Appetizers(Any 7 choices) 2',
            'slug' => 'mixed-appetizers',
            'description' => 'Authentic Style Turkish Tzatziki Served with Homemade Turkish Bread or Pita Bread',
            'price' => '3600.00',
        ]);
        Menu::create([
            'category_id' => 3,
            'name' => 'Mixed Appetizers(Any 7 choices) 3',
            'slug' => 'mixed-appetizers',
            'description' => 'Authentic Style Turkish Tzatziki Served with Homemade Turkish Bread or Pita Bread',
            'price' => '3750.00',
        ]);
    }
}
