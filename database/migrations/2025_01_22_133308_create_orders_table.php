<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du client
            $table->string('email'); // Email du client
            $table->string('address'); // Adresse du client
            $table->string('phone'); // Téléphone du client
            $table->json('products'); // Liste des produits (au format JSON)
            $table->date('order_date'); // Date de la commande
            $table->decimal('total', 10, 2); // Total de la commande
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders'); // Supprime la table si elle existe
    }
}
