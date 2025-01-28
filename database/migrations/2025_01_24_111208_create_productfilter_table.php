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
        Schema::create('productfilter', function (Blueprint $table) {
            $table->unsignedBigInteger('filter_id'); // Colonne filter_id
            $table->unsignedBigInteger('product_id'); // Colonne product_id
             

            // Définir les relations
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Ajouter une clé primaire composite
            $table->primary(['filter_id', 'product_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productfilter');
    }
};
