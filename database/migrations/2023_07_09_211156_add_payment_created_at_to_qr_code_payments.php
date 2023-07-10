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
        Schema::table('qr_code_payments', function (Blueprint $table) {
            $table->timestamp('payment_created_at')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qr_code_payments', function (Blueprint $table) {
            $table->dropColumn('payment_created_at');
        });
    }
};
