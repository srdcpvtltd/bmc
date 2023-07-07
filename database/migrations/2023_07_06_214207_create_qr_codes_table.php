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
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('qr_id')->nullable();
            $table->string('usage')->nullable();
            $table->string('fixed_amount')->nullable();
            $table->string('payment_amount')->nullable(); 
            $table->string('customer_id')->nullable(); 
            $table->string('description')->nullable(); 
            $table->string('notes')->nullable(); 
            $table->string('status')->nullable(); 
            $table->string('image_url')->nullable(); 
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qr_codes');
    }
};
