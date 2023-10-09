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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->unsignedBigInteger('establishment_shop_id')->nullable()->after('id');
            $table->foreign('establishment_shop_id')->references('id')->on('establishment_shops')->onDelete('cascade');
            $table->unsignedBigInteger('shop_id')->nullable()->after('id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->string('owner_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('shop_number')->nullable();
            $table->string('shop_rent')->nullable();
            $table->string('shop_size')->nullable();
            $table->string('shop_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('establishment_shop_id');
            $table->dropColumn('shop_id');
            $table->dropColumn('owner_name');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('shop_number');
            $table->dropColumn('shop_rent');
            $table->dropColumn('shop_size');
            $table->dropColumn('shop_type');
        });
    }
};
