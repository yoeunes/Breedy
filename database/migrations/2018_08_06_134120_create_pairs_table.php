<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePairsTable extends Migration {

	public function up()
	{
		Schema::create('pairs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('father_id')->unsigned()->nullable();
			$table->integer('mother_id')->unsigned()->nullable();
			$table->text('notes')->nullable();
			$table->date('date_of_pairing')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('pairs');
	}
}