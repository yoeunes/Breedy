<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsTable extends Migration {

	public function up()
	{
		Schema::create('visits', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date_of_visit');
			$table->text('symptoms')->nullable();
			$table->text('notes')->nullable();
			$table->text('results')->nullable();
			$table->text('drugs')->nullable();
			$table->float('price')->nullable();
			$table->float('price_vat')->nullable();
			$table->integer('contact_id')->unsigned()->nullable();
			$table->integer('animal_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('visits');
	}
}