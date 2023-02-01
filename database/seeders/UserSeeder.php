<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'role'=>1,
            'email' =>'info@admin.com',
            'password' => bcrypt('@Admin!23#'),
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'role'=>2,
            'email' =>'info@user.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
