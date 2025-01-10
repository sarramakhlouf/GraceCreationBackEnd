<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        // Sélectionner une sous-catégorie aléatoire dans la base de données
        $subcategory = Subcategory::inRandomOrder()->first();
        
        return [
            'name' => $this->faker->word(), // Génère Un nom de produit aléatoire
            'description' => $this->faker->sentence(), // Génère Une description aléatoire
            'subcategory_id' => $subcategory->id,
            'price' => $this->faker->randomFloat(2, 5, 1000), // Génère Un prix aléatoire entre 5 et 1000
            'excl_tax_price' => $this->faker->randomFloat(2, 5, 1000), // Génère Prix hors taxe
            'pricePromo' => $this->faker->randomFloat(2, 5, 800), // Génère Un prix promo aléatoire
            'excl_tax_pricePromo' => $this->faker->randomFloat(2, 5, 800), // Génère Prix promo hors taxe
            'image' => $this->faker->imageUrl(640, 480, 'product', true), // URL d'image aléatoire
            'available' => $this->faker->boolean(80), // 80% de chance que le produit soit disponible
            'featured' => $this->faker->boolean(50),
            'new' => $this->faker->boolean(80),
        ];
    }
}
