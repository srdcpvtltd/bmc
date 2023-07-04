<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [ 'id' => 1 ,'name' => 'Admin', 'created_at' => Carbon::now()],
            [ 'id' => 2 ,'name' => 'User', 'created_at' => Carbon::now()],
            [ 'id' => 3 ,'name' => 'Shop Owner', 'created_at' => Carbon::now()],
            [ 'id' => 4 ,'name' => 'ZDC', 'created_at' => Carbon::now()],
            [ 'id' => 5 ,'name' => 'Collection Staff', 'created_at' => Carbon::now()],
        ]);
        DB::table('users')->insert([
            [ 
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'role_id' => '1',
                'password' => Hash::make('1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
