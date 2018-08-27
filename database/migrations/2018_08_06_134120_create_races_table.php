<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRacesTable extends Migration {

	public function up()
	{
		Schema::create('races', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_race');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('team_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('races');
	}
}
