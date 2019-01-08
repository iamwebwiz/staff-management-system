<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gbeila Aliu Wahab',
            'email' => 'aliuwahab@gmail.com',
        	'password' => bcrypt('secret'),
        	'is_admin' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('users')->insert([
            'name' => 'Faiq Eshan Aliu',
            'email' => 'admin@site.com',
            'password' => bcrypt('secret'),
            'is_admin' => false,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);



    }
}
