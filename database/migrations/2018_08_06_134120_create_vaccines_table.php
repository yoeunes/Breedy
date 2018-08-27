<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVaccinesTable extends Migration {

	public function up()
	{
		Schema::create('vaccines', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date_of_vaccination');
			$table->date('date_of_recall')->nullable();
			$table->text('notes')->nullable();
			$table->integer('vaccine_categories_id')->unsigned()->nullable();
			$table->integer('contact_id')->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('animal_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('vaccines');
	}
}