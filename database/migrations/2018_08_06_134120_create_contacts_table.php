<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('street1', 255)->nullable();
			$table->string('street2', 255)->nullable();
			$table->string('zip', 100)->nullable();
			$table->string('country', 255)->nullable();
			$table->string('city', 255)->nullable();
			$table->string('state', 255)->nullable();
			$table->string('phone_mobile', 100)->nullable();
			$table->string('phone_fix', 100)->nullable();
			$table->string('fax', 100)->nullable();
			$table->string('email', 255)->nullable();
			$table->string('company_name', 255)->nullable();
			$table->string('vat', 255)->nullable();
			$table->string('website', 255)->nullable();
			$table->string('breeding_name', 255)->nullable();
			$table->text('note')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('team_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}