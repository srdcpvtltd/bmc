<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        DB::table('roles')->where('id',6)->delete();
        DB::table('roles')->insert([
            [ 'id' => 6 ,'name' => 'Super Admin', 'created_at' => Carbon::now()],
        ]);
        DB::table('users')->insert([
            [ 
                'name' => 'Super Admin',
                'email' => 'super_admin@mail.com',
                'role_id' => '6',
                'password' => Hash::make('1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
