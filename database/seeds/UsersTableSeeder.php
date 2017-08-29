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
        	'name' => 'Site Administrator',
        	'email' => 'admin@site.com',
        	'password' => bcrypt('secret')
        ]);
    }
}
