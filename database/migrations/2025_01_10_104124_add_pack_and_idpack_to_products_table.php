<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('pack')->default(false); // Champ booléen avec une valeur par défaut
            $table->unsignedBigInteger('pack_id')->nullable(); // Champ idpack, nullable
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['pack', 'pack_id']); // Supprimer les colonnes lors de la migration inversée
        });
    }
};
