<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration {

	public function up()
	{
		Schema::create('reservations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('reservation_number', 255);
			$table->float('full_price');
			$table->float('pending_price')->nullable();
			$table->string('status', 255)->nullable();
			$table->date('date_end')->nullable();
			$table->integer('team_id')->unsigned();
			$table->integer('animal_id')->unsigned();
			$table->integer('customer_id')->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('reservations');
	}
}