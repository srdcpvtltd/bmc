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
        Schema::table('shops', function (Blueprint $table) {
            $table->date('allotment_date')->nullable()->before('created_at');
            $table->string('number_of_years')->nullable()->before('created_at');
            $table->date('valid_upto')->nullable()->before('created_at');
            $table->string('allotment_number')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn('allotment_date');
            $table->dropColumn('number_of_years');
            $table->dropColumn('valid_upto');
            $table->dropColumn('allotment_number');
        });
    }
};
