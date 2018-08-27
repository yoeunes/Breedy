<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimalsTable extends Migration {

	public function up()
	{
        Schema::create('animals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name_full', 255)->nullable();
            $table->string('name_domestic', 255)->nullable();
            $table->string('id_number', 255);
            $table->string('id_number_2', 255)->nullable();
            $table->string('category', 255);
            $table->date('date_of_birth');
            $table->date('date_of_death')->nullable();
            $table->string('sex', 255);
            $table->string('color', 255)->nullable();
            $table->string('picture', 255)->nullable();
            $table->string('breeder', 255)->nullable();
            $table->string('owner', 255)->nullable();
            $table->boolean('sterilized')->default(0);
            $table->text('notes')->nullable();
            $table->integer('father_id')->nullable();
            $table->integer('mother_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->string('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->integer('team_id')->unsigned();
            $table->integer('type_id')->unsigned()->nullable();
            $table->integer('race_id')->unsigned()->nullable();
            $table->integer('reservation_id')->unsigned()->nullable();
            $table->integer('color_id')->unsigned()->nullable();
            $table->integer('foster_home_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('animals');
	}
}
