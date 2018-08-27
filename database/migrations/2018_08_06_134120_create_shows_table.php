<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShowsTable extends Migration {

	public function up()
	{
		Schema::create('shows', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('location', 255)->nullable();
			$table->datetime('date')->nullable();
			$table->string('club', 255)->nullable();
			$table->string('judge', 255)->nullable();
			$table->string('organization', 255)->nullable();
			$table->string('result', 255)->nullable();
			$table->string('class', 255)->nullable();
			$table->string('grading', 255)->nullable();
			$table->text('notes')->nullable();
			$table->integer('animal_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('shows');
	}
}