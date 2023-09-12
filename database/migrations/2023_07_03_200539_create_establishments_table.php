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
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('total_shops')->default(0);
            $table->unsignedBigInteger('establishment_category_id')->nullable();

            $table->unsignedBigInteger('establishment_zone_id')->nullable();
            $table->foreign('establishment_zone_id')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('establishments');
    }
};
