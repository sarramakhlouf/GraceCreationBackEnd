<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\SubCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::factory(10)->create()->each(function ($product) {
            // Assign a random SubCategory to the product
            $subCategory = SubCategory::inRandomOrder()->first(); 
            $product->subCategory()->associate($subCategory);
            $product->save();
        });
    }
}
