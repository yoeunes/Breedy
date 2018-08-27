<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConditionsTable extends Migration {

	public function up()
	{
		Schema::create('conditions', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date_of_condition');
			$table->string('name', 255);
			$table->text('notes')->nullable();
			$table->text('results')->nullable();
			$table->integer('animal_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('conditions');
	}
}