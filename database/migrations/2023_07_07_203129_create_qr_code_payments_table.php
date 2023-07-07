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
        Schema::create('qr_code_payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_id')->nullable(); 
            $table->unsignedBigInteger('qr_code_id')->nullable();
            $table->foreign('qr_code_id')->references('id')->on('qr_codes')->onDelete('cascade');
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
        Schema::dropIfExists('qr_code_payments');
    }
};
