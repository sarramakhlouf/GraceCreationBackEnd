<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::factory(10)->create()->each(function ($inventory) {
            // Associer un dépôt aléatoire à chaque inventaire
            $depot = Depot::inRandomOrder()->first();
            $inventory->depot()->associate($depot);
            $inventory->save();
        });
    }
}
