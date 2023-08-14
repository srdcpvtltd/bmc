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
        Schema::create('establishment_shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_number')->nullable();
            $table->string('shop_rent')->nullable();
            $table->string('shop_size')->nullable();
            $table->string('shop_type')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->unsignedBigInteger('establishment_id')->nullable();
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
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
        Schema::dropIfExists('establishment_shops');
    }
};
