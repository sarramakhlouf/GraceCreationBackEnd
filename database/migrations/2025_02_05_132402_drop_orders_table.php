<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOrdersTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('orders');
    }

    public function down()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->json('products');
            $table->date('date');
            $table->decimal('total', 10, 2);
            $table->enum('status', [0, 1, 2]);
            $table->timestamps();
        });
    }
}
