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
        Schema::create('furniture_orders', function (Blueprint $table) {
            $table->id();
            $table->string('item_status');
            $table->string('location');
            $table->integer('quantity_ordered');
            $table->boolean('is_dispute');
            $table->text('feedback');
            $table->index('order_id');
            $table->index('furniture_id');
            $table->timestamps();

            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('furniture_id')->constrained('furniture')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_orders');
    }
};
