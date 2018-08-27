<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_number');
			$table->string('first_name', 255);
			$table->string('last_name', 255);
			$table->string('email', 255)->nullable();
			$table->string('phone_mobile', 255)->nullable();
			$table->string('phone_fix', 255)->nullable();
			$table->string('fax', 255)->nullable();
			$table->string('street1', 255)->nullable();
			$table->string('street2', 255)->nullable();
			$table->string('state', 255)->nullable();
			$table->string('zip', 255)->nullable();
			$table->string('city', 255)->nullable();
			$table->string('country', 255)->nullable();
			$table->string('language', 255)->nullable();
			$table->string('customer_type', 255);
			$table->boolean('is_pro');
			$table->string('company_name', 255)->nullable();
			$table->string('vat', 255)->nullable();
			$table->text('notes')->nullable();
			$table->integer('team_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}