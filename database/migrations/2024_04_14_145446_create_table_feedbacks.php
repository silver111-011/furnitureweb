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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->text('feedback');
            $table->index('seller_id');
            $table->index('customer_id');
            $table->index('order_id');
            $table->timestamps();

            
            $table-> foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table-> foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table-> foreignId('order_id')->constrained('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
};
