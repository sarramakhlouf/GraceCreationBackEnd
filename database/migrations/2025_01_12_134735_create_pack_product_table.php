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
        Schema::create('pack_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pack_id'); // L'ID du pack
            $table->unsignedBigInteger('product_id'); // L'ID du produit associé
            $table->timestamps();
        
            // Clés étrangères
            $table->foreign('pack_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pack_product');
    }
};
