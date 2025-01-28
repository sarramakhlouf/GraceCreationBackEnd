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
        Schema::table('orders', function (Blueprint $table) {
            // Ajouter une colonne pour l'email du client
            $table->string('client_email')->nullable()->after('client_name');
        });
    }
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Supprimer la colonne si la migration est annulée
            $table->dropColumn('client_email');
        });
    }
};
