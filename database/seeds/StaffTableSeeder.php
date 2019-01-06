<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'age' => 29,
            'phone' => +233204040404,
            'image' => 'Eshan Faiq Aliu1546381064.jpg',
            'address' => 'Shallom Estate, Accra',
            'city' => 'Accra',
            'state' => 'Greater Accra',
            'country' => 'Ghana',
            'level' => 'Manager',
            'user_id' => \App\User::first()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'start_work_date' => \Carbon\Carbon::now(),
        ]);



        DB::table('staff')->insert([
            'age' => 29,
            'phone' => +2332040422,
            'image' => 'Eshan Faiq Aliu1546381064.jpg',
            'address' => 'Shallom Estate, Accra',
            'city' => 'Accra',
            'state' => 'Greater Accra',
            'country' => 'Ghana',
            'level' => 'Manager',
            'user_id' => \App\User::find(2)->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'start_work_date' => \Carbon\Carbon::now(),
        ]);


    }
}
