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
        Schema::table('pending_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('establishment_id')->nullable()->after('id');
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pending_payments', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('establishment_id');
        });
    }
};
