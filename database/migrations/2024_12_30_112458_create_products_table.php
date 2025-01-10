<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('subcategory_id') // Clé étrangère vers la table sous-categories
                ->constrained('subcategories'); // Relie à la table sous-categories
            $table->integer('subcategory_id')->nullable()->change();
            $table->decimal('price', 8, 2);
            $table->decimal('excl_tax_price', 8, 2);
            $table->decimal('pricePromo', 8, 2);
            $table->decimal('excl_tax_pricePromo', 8, 2);
            $table->string('image')->nullable(); // To store the image path or URL
            $table->boolean('available')->default(true); // To indicate if the product is available
            $table->boolean('featured')->default(false);
            $table->boolean('new')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
