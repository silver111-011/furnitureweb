<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('quantity');
            $table->string('imagepath');
            $table->string('description');
            $table->integer('ordered_quantity')->default(0);
            $table->boolean('switch')->default(0);
            $table->index('category_id');
            $table->index('seller_id');
           
            $table->timestamps();

            $table-> foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table-> foreignId('category_id')->constrained('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furnitures');
    }
};
