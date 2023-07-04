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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('shop_number')->nullable();
            $table->string('shop_rent')->nullable();
            $table->string('shop_size')->nullable();
            $table->string('shop_type')->nullable();
            $table->string('lat_long')->nullable();
            $table->string('rent_frequency')->nullable();
            $table->string('id_proof')->nullable();
            $table->string('id_proof_number')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
            $table->unsignedBigInteger('establishment_id')->nullable();
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedBigInteger('structure_id')->nullable();
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('cascade');
            $table->unsignedBigInteger('establishment_category_id')->nullable();
            $table->foreign('establishment_category_id')->references('id')->on('establishment_categories')->onDelete('cascade');
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
        Schema::dropIfExists('shops');
    }
};
