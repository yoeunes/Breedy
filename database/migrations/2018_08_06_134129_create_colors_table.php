<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColorsTable extends Migration {
    
    public function up()
    {
        Schema::create('colors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name_color', 255);
            $table->integer('team_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down()
    {
        Schema::drop('colors');
    }
}
