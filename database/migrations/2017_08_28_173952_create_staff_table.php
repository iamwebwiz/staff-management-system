<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
//            $table->string('name');
//            $table->string('email')->unique();
            $table->integer('age');
            $table->string('phone');
            $table->string('image');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country')
            	->default('Nigeria')
            	->nullable();
            $table->enum('level', [
            	'Intern',
            	'Junior',
            	'Senior',
            	'Supervisor',
            	'Manager'
            ])->default('Intern');
            $table->integer('user_id');
            $table->timestamps();
            $table->timestamp('start_work_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
