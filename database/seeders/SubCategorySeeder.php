<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::factory(10)->create()->each(function ($subCategory) {
            // Associer une catégorie aléatoire à chaque sous-catégorie
            $category = Category::inRandomOrder()->first();
            $subCategory->category()->associate($category);
            $subCategory->save();
        });
    }

}
